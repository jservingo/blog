<?php

use Illuminate\Database\Seeder;
use App\Contact;
use App\Group;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Contactos de Jorge

        $contact = new Contact();  //1
        $contact->user_id = 1;
        $contact->user_ref = 2;
        $contact->comment = "Este es un comentario sobre Peter";
        $contact->save();

        $contact = new Contact();  //3
        $contact->user_id = 1;
        $contact->user_ref = 3;
        $contact->comment = "Este es un comentario sobre Alejandro";
        $contact->save(); 

        $contact = new Contact();  //4
        $contact->user_id = 1;
        $contact->user_ref = 4;
        $contact->comment = "Este es un comentario sobre Carlos";
        $contact->save(); 

        //Contactos de Peter

        $contact = new Contact();  //2
        $contact->user_id = 2;
        $contact->user_ref = 1;
        $contact->comment = "Este es un comentario sobre Jorge";
        $contact->save();

        $contact = new Contact();  //5
        $contact->user_id = 2;
        $contact->user_ref = 5;
        $contact->comment = "Este es un comentario sobre Luis";
        $contact->save();

        $contact = new Contact();  //6
        $contact->user_id = 2;
        $contact->user_ref = 6;
        $contact->comment = "Este es un comentario sobre Alfredo";
        $contact->save();

        //Grupos de contactos

        $group = new Group();  //1
        $group->user_id = 1;        
        $group->name = "Grupo de contactos de Jorge";
        $group->save();
        $group->contacts()->attach(2);

        $group = new Group();  //2
        $group->user_id = 2;        
        $group->name = "Grupo de contactos de Peter";
        $group->save();
        $group->contacts()->attach(1);
    }
}
