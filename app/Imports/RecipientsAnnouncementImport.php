<?php

namespace App\Imports;

use App\RecipientsAnnouncement;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class RecipientsAnnouncementImport implements ToCollection
{
    public function  __construct($group_announcement_id ) {
        $this->group_announcement_id = $group_announcement_id ;
    }

    public function collection(Collection $rows){
        foreach ($rows as $row) {
            if( isset($row[0]) && isset($row[1]) ) {
                $checkEmail = RecipientsAnnouncement::where(['email'=>$row[1],'groups_announcement_id'=>$this->group_announcement_id])->first();
                if(!$checkEmail && self::validateEmail(trim($row[1]))) {
                    RecipientsAnnouncement::create([
                        'groups_announcement_id' => $this->group_announcement_id,
                        'name' => $row[0],
                        'email' => $row[1],
                    ]);
                }
            }
        }
    }

    function validateEmail($email) {
        return (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email))?FALSE:TRUE;
    }  

}
