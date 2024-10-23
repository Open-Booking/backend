<?php

namespace App\Modules\CoreModule\Jobs;

use App\Enums\UserStatusEnum;
use App\Exceptions\UnauthorizedException;
use App\Models\RoleAbility;
use App\Models\User;
use App\Next\Core\Job;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class LoginJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private array $payload)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $user = User::with('role')
                ->where('status', UserStatusEnum::ACTIVE->value)
                ->where(function ($query) {
                    $query->where('username', $this->payload['identifier'])
                        ->orwhere('email', $this->payload['identifier'])
                        ->orWhere('mobile_number', $this->payload['identifier']);
                })
                ->firstOrFail();
        } catch (ModelNotFoundException $_) {
            throw new UnauthorizedException('Wrong Credentials');
        }

        if (Hash::check($this->payload['password'], $user->password) || Hash::check($this->payload['password'], $user->passcode)) {
            $userAbilities = RoleAbility::join('abilities', 'role_ability.ability_id', '=', 'abilities.id')
                ->where('role_id', $user->role_id)
                ->select('action', 'subject')->get();

            return [
                'access_token' => $user->createToken('Authentication Token')->plainTextToken,
                'user_data' => $user,
                'abilities' => $userAbilities,
            ];
        } else {
            throw new UnauthorizedException('Wrong Credentials');
        }
    }
}
