<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use App\Notifications\UserCreatedNotification;
use Filament\Resources\Pages\CreateRecord;
use Ramsey\Uuid\Uuid;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterCreate(): void
    {
        $user = User::find($this->record->id);

        $user->type = 'db';
        $user->password = bcrypt(uniqid());
        $user->creation_token = Uuid::uuid4()->toString();
        $user->save();

        $user->notify(new UserCreatedNotification($user));
    }
}
