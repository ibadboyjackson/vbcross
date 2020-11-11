<?php

use App\User;
use App\UserQA;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleUser = Role::create(['name' => 'user']);


        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@demo.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => Hash::make('password'),
        ]);

        $user1 = User::create([
            'name' => 'User1',
            'username' => 'user1',
            'email' => 'user1@demo.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => Hash::make('password'),
        ]);

        $user2 = User::create([
            'name' => 'User2',
            'username' => 'user2',
            'email' => 'user2@demo.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => Hash::make('password'),
        ]);

        $user3 = User::create([
            'name' => 'User3',
            'username' => 'user3',
            'email' => 'user3@demo.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => Hash::make('password'),
        ]);

        $admin->assignRole($roleAdmin);
        $user1->assignRole($roleUser);
        $user2->assignRole($roleUser);
        $user3->assignRole($roleUser);

        foreach (UserQA::QUESTIONS as $key => $label) {
            UserQA::create([
                'user_id' => $user1->id,
                'question' => $key,
                'answer' => $key,
            ]);
        }

        foreach (UserQA::QUESTIONS as $key => $label) {
            UserQA::create([
                'user_id' => $user2->id,
                'question' => $key,
                'answer' => $key,
            ]);
        }

        foreach (UserQA::QUESTIONS as $key => $label) {
            UserQA::create([
                'user_id' => $user3->id,
                'question' => $key,
                'answer' => $key,
            ]);
        }

        // initialize chat arena 1
        $participantsChatArena1 = [$admin, $user1, $user2, $user3];
        $conversationChatArena1 = Chat::createConversation($participantsChatArena1);
        $dataChatArena1 = ['title' => 'Chat Arena 1', 'description' => 'Public Chat Arena 1 for all Members'];
        $conversationChatArena1->update(['data' => $dataChatArena1]);
        Chat::message('initial message')
            ->from($admin)
            ->to($conversationChatArena1)
            ->send();

        // initialize chat arena 2
        $participantsChatArena2 = [$admin, $user1, $user2, $user3];
        $conversationChatArena2 = Chat::createConversation($participantsChatArena2);
        $dataChatArena2 = ['title' => 'Chat Arena 2', 'description' => 'Public Chat Arena 2 for all Members'];
        $conversationChatArena2->update(['data' => $dataChatArena2]);

        // initialize recreation chat
        $participantsRecreation = [$admin, $user1, $user2, $user3];
        $conversationRecreation = Chat::createConversation($participantsRecreation);
        $dataRecreation = ['title' => 'Recreation', 'description' => 'Just like chat arena but you can type publicly'];
        $conversationRecreation->update(['data' => $dataRecreation]);

    }
}
