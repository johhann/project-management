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

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['password'] = bcrypt(uniqid());
        $data['creation_token'] = Uuid::uuid4()->toString();

        return $data;
    }

    // send email for password after creating user
    protected function afterCreate(): void
    {
        $this->record = User::find($this->record->id);

        if ($this->record->type == 'db') {
            $this->record->notify(new UserCreatedNotification($this->record));
        }
    }
}
