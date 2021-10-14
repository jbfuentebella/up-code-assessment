<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCompanyLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
    ];

    // public function processUserCompanyLinking($video, $accounts)
    // {
    //     $gchatId = $video->groupChat->id;
    //     $oldAccounts = $video->livePerformers;
    //     $newAccounts = [];

    //     if ($oldAccounts->isEmpty()) {
    //         return $this->createGChatLivePerformerLinks($video->id, $gchatId, $accounts);
    //     } else {
    //         $oldAccounts = $oldAccounts->pluck('id')->toArray();
    //     }

    //     if (!empty($accounts)) {
    //         $newAccounts = explode(',', $accounts);
    //     }

    //     $diffAccounts = array_diff($oldAccounts, $newAccounts);
    //     $addAccounts = array_diff($newAccounts, $oldAccounts);

    //     // remove old accounts
    //     foreach ($diffAccounts as $kdaccount => $vdaccountId) {
    //         $oldInstructor = GChatLivePerformerLink::where('video_id', $video->id)
    //             ->where('account_id', $vdaccountId)
    //             ->where('gchat_id', $gchatId)
    //             ->first();

    //         $oldInstructor->delete();
    //     }

    //     // create new accounts
    //     if (!empty($addAccounts)) {
    //         return $this->createGChatLivePerformerLinks($video->id, $gchatId, implode(',', $addAccounts));    
    //     }

    //     return true;
    // }

    // public function createGChatLivePerformerLinks($videoId, $gchatId, $accounts)
    // {
    //     if (!empty($accounts)) {
    //         $accounts = explode(',', $accounts);

    //         $hasError = false;

    //         foreach ($accounts as $kaccount => $vaccountId) {
    //             $attr = [
    //                 'video_id' => $videoId,
    //                 'account_id' => $vaccountId,
    //                 'gchat_id' => $gchatId
    //             ];

    //             $model = $this->model->newInstance($attr);    
    //             if (!$model->save()) {
    //                 $hasError = true;
    //             }
    //         }

    //         if ($hasError) {
    //             return false;
    //         }
    //     }

    //     return true;
    // }

    public function createUserCompanyLinking($company, $users)
    {
        if (!empty($users)) {
            $hasError = false;

            foreach ($users as $index => $userId) {
                $attr = [
                    'company_id' => $company->id,
                    'user_id' => $userId
                ];

                $model = new UserCompanyLink($attr);
                if (!$model->save()) {
                    $hasError = true;
                }
            }

            if ($hasError) {
                return false;
            }
        }

        return true;
    }

    public function updateUserCompanyLinking($company, $users)
    {
        $oldUsers = $company->users;
        $newUsers = [];

        if ($oldUsers->isEmpty()) {
            return $this->createUserCompanyLinking($company, $users);
        } else {
            $oldUsers = $oldUsers->pluck('id')->toArray();
        }

        if (!empty($users)) {
            $newUsers = $users;
        }

        $diffUsers = array_diff($oldUsers, $newUsers);
        $addUsers = array_diff($newUsers, $oldUsers);

        // remove old accounts
        foreach ($diffUsers as $index => $userId) {
            $oldUser = UserCompanyLink::where('user_id', $userId)
                ->where('company_id', $company->id)
                ->first();

            $oldUser->delete();
        }

        // create new accounts
        if (!empty($addUsers)) {
            return $this->createUserCompanyLinking($company, $addUsers);    
        }

        return true;
    }

    public function removeAllUserConnections($company) {
        $oldUsers = UserCompanyLink::where('company_id', $company->id)->get();
        
        foreach($oldUsers as $oldUser) {
            $oldUser->delete();
        }

        return true;
    }
}
