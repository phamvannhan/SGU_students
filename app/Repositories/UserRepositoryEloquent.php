<?php

namespace App\Repositories;

use App\Jobs\ChatRoomFirebase;
use App\Jobs\UserInChatRoomFirebase;
use App\Mail\ResetPasswordEmail;
use App\Mail\SendLinkResetPasswordEmail;
use App\Models\ApiPasswordReset;
use App\Models\City;
use App\Traits\UploadPhotoTrait;
use Carbon\Carbon;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserRepository;
use App\Models\User;

/**
 * Class UserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    use UploadPhotoTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function datatable($role_id)
    {
        $model = $this->model->select('id', 'name', 'email', 'phone', 'created_at')
            ->with(['roles']);
        if (!empty($role_id)) {
            $model->whereHas('roles', function ($query) use ($role_id) {
                $query->where('roles.id', $role_id);
            });
        }
        return $model;
    }

    public function store(array $input)
    {
        $input["password"] = \Hash::make($input["password"]);

        $input["active"] = !empty($input["active"]) ? 1 : 0;

        $input["active_code"] = uniqid("", true);

        if (!empty($input["birthday"])) {
            $input["birthday"] = cvDbTime($input["birthday"], PHP_DATE, DB_DATE);
        }

        if (!empty($input["id_number_date"])) {
            $input["id_number_date"] = cvDbTime($input["id_number_date"], PHP_DATE, DB_DATE);
        }

        // cmnd
        if (!empty($input['user_front_id'])) {

            $config = config('files.user_cmnd');

            $info = $this->storePhoto($input['user_front_id'], $config);

            $input['front_id'] = $info['full_path'];
        }

        if (!empty($input['user_backside_id'])) {
            $config = config('files.user_cmnd');

            $info = $this->storePhoto($input['user_backside_id'], $config);

            $input['backside_id'] = $info['full_path'];
        }

        if (!empty($input['user_avatar'])) {
            $config = config('files.user_avatar_admin');

            $info = $this->storePhoto($input['user_avatar'], $config);

            $input['avatar'] = $info['full_path'];
        }


        $user = $this->model->create($input);

        $user->syncRoles($input["role"]);

        if (!empty($input["permission"])) {
            $user->syncPermissions($input["permission"]);
        }

        // Save uset to city room chat
        if (!empty($input['city_id'])) {
            $city = City::find($input['city_id']);
            dispatch(new ChatRoomFirebase("city_{$input['city_id']}", [
                'name' => $city->name,
                'avatar' => asset(NO_LOGO),
                "users/{$user->id }" => true
            ], 'update'));
        }

        return $user;
    }

    public function update(array $input, $id)
    {
        $user = $this->model->findOrFail($id);

        if (!empty($input["password"])) {
            $input["password"] = \Hash::make($input["password"]);
        } else {
            unset($input["password"]);
        }

        $input["active"] = !empty($input["active"]) ? 1 : 0;

        if (!empty($input["birthday"])) {
            $input["birthday"] = cvDbTime($input["birthday"], PHP_DATE, DB_DATE);
        }

        if (!empty($input["id_number_date"])) {
            $input["id_number_date"] = cvDbTime($input["id_number_date"], PHP_DATE, DB_DATE);
        }

        if (!empty($input["delete_front_id"])) {
            $this->destroySinglePhoto($input["delete_front_id"]);
            $input['front_id'] = null;
        }

        if (!empty($input["delete_backside_id"])) {
            $this->destroySinglePhoto($input["delete_backside_id"]);
            $input['backside_id'] = null;
        }

        if (!empty($input["delete_avatar"])) {
            $this->destroySinglePhoto($input["delete_avatar"]);
            $input['avatar'] = null;
        }

        // cmnd
        if (!empty($input['user_front_id'])) {

            $config = config('files.user_cmnd');

            $info = $this->storePhoto($input['user_front_id'], $config);

            $input['front_id'] = $info['full_path'];
        }

        if (!empty($input['user_backside_id'])) {
            $config = config('files.user_cmnd');

            $info = $this->storePhoto($input['user_backside_id'], $config);

            $input['backside_id'] = $info['full_path'];
        }

        if (!empty($input['user_avatar'])) {
            $config = config('files.user_avatar_admin');

            $info = $this->storePhoto($input['user_avatar'], $config);

            $input['avatar'] = $info['full_path'];
        }


        // firebase for chat room
        if (!empty($input['city_id'])) { // thêm user đó vào new city room
            if ($input['city_id'] != $user->city_id) {
                $city = City::find($input['city_id']);
                dispatch(new ChatRoomFirebase("city_{$input['city_id']}", [
                    'name' => $city->name,
                    'avatar' => asset(NO_LOGO),
                    "users/{$user->id }" => true
                ], 'update'));

                if ($user->city_id) { // Remove user in old city room
                    dispatch(new UserInChatRoomFirebase("city_{$user->city_id}", $user->id, null));
                }
            }
        } else {
            if ($user->city_id) { // Remove user in old city room
                dispatch(new UserInChatRoomFirebase("city_{$user->city_id}", $user->id, null));
            }
        }

        $user->update($input);

        $user->syncRoles($input["role"]);

        if (!empty($input["permission"])) {
            $user->syncPermissions($input["permission"]);
        } else {
            $user->detachAllPermissions();
        }

        return $user;
    }

    public function delete($id)
    {
        $model = $this->model->findOrFail($id);

        if ($model->city_id) { // Remove user in old city room
            dispatch(new UserInChatRoomFirebase("city_{$model->city_id}", $model->id, null));
        }

        $model->delete();
    }

    public function resetLink($email)
    {
        $user = $this->model->where('email', $email)->firstOrFail();

        // Create token
        $token = uniqid("", true) . "_" . date("YmdHis");

        // Remove all reset key
        ApiPasswordReset::where("user_id", $user->id)->delete();

        // create new reset token
        ApiPasswordReset::create([
            "user_id" => $user->id,
            "token" => $token
        ]);

        $link = route("frontend.auth.reset", $token);

        \Mail::to($email)->send(new SendLinkResetPasswordEmail($link));
    }

    public function resetPassword($token)
    {
        $max_time = 24 * 60 * 60;

        $check = ApiPasswordReset::where('token', $token)->with(['user'])->firstOrFail();

        $check_date = Carbon::createFromFormat('Y-m-d H:i:s', $check->created_at)->timestamp + $max_time;

        $now = Carbon::now()->timestamp;

        if ($now > $check_date) {
            return false;
        } else {
            // Update new password
            $password = randStrGen(8, '0123456789');
            $check->user->update([
                'password' => \Hash::make($password)
            ]);

            // Update invalid link reset
            $check->update([
                'token' => $token . '-' . date('YmdHis')
            ]);

            \Mail::to($check->user)->send(new ResetPasswordEmail($password));
            return true;
        }
    }

    public function companies(User $user)
    {
        return $user->companies()->paginate(5);
    }

    public function updateProfile(array $input, User $user)
    {
        if (!empty($input["password"])) {
            $input["password"] = \Hash::make($input["password"]);
        } else {
            unset($input["password"]);
        }
        if (!empty($input["birthday"])) {
            $input["birthday"] = cvDbTime($input["birthday"], PHP_DATE, DB_DATE);
        }

        if (!empty($input['avatar'])) {

            $this->destroySinglePhoto($user->avatar);

            $config = config('files.user_avatar');

            $info = $this->storePhoto($input['avatar'], $config);

            $input['avatar'] = $info['full_path'];
        }

        $user->update($input);

        return $user;

    }

    public function listChat($auth_id, array $friend)
    {
        $model = $this->model->select('id', 'name', 'avatar');
        if (!empty($friend)) {
            $model->addSelect(\DB::raw('IF(id IN  (' . implode(',', $friend) . '), 1, 0) as is_friend'));
        } else {
            $model->addSelect(\DB::raw('1 as is_friend'));
        }

        return $model->where('id', '!=', $auth_id)
            ->orderBy('is_friend', 'desc')
            ->paginate(20);
    }

    public function chatRoomUserByIds(array $ids)
    {
        return $this->model->select('id', 'name', 'avatar')->whereIn('id', $ids)->get();
    }

    public function userByRoleIds($ids, $select = '*')
    {
        $model =  $this->model->select($select);
        if(!empty($ids)){{
            $model->whereHas('roles', function ($query) use ($ids) {
                if (is_array($ids)) {
                    $query->whereIn('roles.id', $ids);
                } else {
                    $query->where('roles.id', $ids);
                }
            });
        }}
        return $model->get();
    }

    public function userByRoleSlugs($slugs, $select = '*')
    {
        $model =  $this->model->select($select);
        if(!empty($slugs)){{
            $model->whereHas('roles', function ($query) use ($slugs) {
                if (is_array($slugs)) {
                    $query->whereIn('roles.slug', $slugs);
                } else {
                    $query->where('roles.slug', $slugs);
                }
            });
        }}
        return $model->get();
    }
}
