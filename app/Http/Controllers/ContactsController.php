<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Contact;
use App\Group;
use App\Kpost;
use App\Post;

class ContactsController extends Controller
{
  //Aqui hay que colocar el método que muestra y
	//hay que modificar la vista de los posts

  public function discover()
  {
    $posts = Post        
      ::where("posts.user_id","<>",auth()->id())
      ->where("type_id","=",24)
      ->whereNotIn('ref_id', function($query)
        {
          $query->select('user_ref')
                ->from('contacts')
                ->where('user_id','=',auth()->id());
        })
      ->latest('posts.created_at')
      ->paginate(12);

    $title = "Discover users";   
    $root = "discover_users";
    $buttons = "posts.buttons.discover_users"; 
    $subtitle = "";

    return view(get_view(),compact(
      'posts','title','root','buttons','subtitle'));
  }

	public function show_contacts()
  {
  	$posts = Post
  		::join('users', 'ref_id', '=', 'users.id')
  		->join('contacts', 'users.id', '=', 'contacts.user_ref')
  		->where("type_id","=",24)
  		->where("contacts.user_id","=",auth()->id())
  		->orderBy('users.name', 'asc')
      ->select('posts.*')
  		->paginate(12);	

  	/* QUITAR ESTO
    $groups = Group
  		::where("user_id","=",auth()->id())
      ->where("parent_id","=",null)
  		->orderBy('name', 'asc')
  		->get();
    */

  	$title = "Contacts";
    $root = "contacts";
    $group_id = 0;
    $buttons = "posts.buttons.contacts";
    $subtitle = "";     

    return view(get_view(),compact('posts','title','root','group_id','buttons','subtitle'));	
  }

  public function show_group(Group $group)
  {
  	$posts = Post
  	  ::join('users', 'ref_id', '=', 'users.id')
  		->join('group_user', 'users.id', '=', 'group_user.user_id')
  		->join('groups', 'group_user.group_id', '=', 'groups.id')  		
  		->where("type_id","=",24)
  		->where('groups.id',"=",$group->id)
  		->orderBy('users.name', 'asc')
      ->select('posts.*')
  		->paginate(12);	

  	/* QUITAR ESTO
    $groups = Group
  		::where("user_id","=",auth()->id())
      ->where("parent_id","=",null)
  		->orderBy('name', 'asc')
  		->get();
    */

  	$title = "Contacts";
    $root = "contacts_group";
    $group_id = $group->id;
    $buttons = "posts.buttons.contacts";  
    $subtitle = "";   

    return view(get_view(),compact('posts','title','root','group_id','buttons','subtitle'));	
  }

  public function get_stats(Post $post)
  {
    $user = User
      ::where("id","=",$post->ref_id)
      ->first();

    $apps = App
      ::where("user_id","=",$user->id)
      ->where("parent_id","=",null)
      ->count(); 

    $pages = Page
      ::where("user_id","=",$user->id)
      ->count(); 

    $catalogs = Catalog
      ::where("user_id","=",$user->id)
      ->count(); 

    $posts = Post
      ::where("user_id","=",$user->id)
      ->where("type_id","<=",20)
      ->count(); 

    $result = array("apps"=>$apps,
                    "pages"=>$pages,
                    "catalogs"=>$catalogs,
                    "posts"=>$posts); 
      
    echo json_encode($result); 
  }

  public function destroy(Post $post)
  {
    $co = Contact
      ::where("user_ref","=",$post->ref_id)
      ->where("user_id","=",auth()->id())
      ->first();

    if ($co) {
      $co->delete();
    }

    //Eliminar el contacto de todas las listas
    $users = DB::table('group_user')
      ->join('groups','groups.id','=','group_user.group_id')
      ->where("group_user.user_id","=",$post->ref_id)
      ->where("groups.user_id","=",auth()->id())
      ->select('group_user.*')
      ->delete();

    //Eliminar kpost del contacto
    /*
    $kpost = Kpost
      ::where("post_id","=",$post->id)
      ->where("user_id","=",auth()->id())
      ->first(); 

    if ($kpost)
      $kpost->delete();  
    */

    echo json_encode(array('success'=>true));
  }

  public function add_user_to_contacts(Request $request)
  {
    $user_id = $request->get('user_id');

    $contact = Contact::firstOrCreate([
      'user_id' => auth()->id(),
      'user_ref' => $user_id
      ]
    );

    $post = Post
      ::where("type_id","=",24)
      ->where("ref_id","=",$user_id)
      ->first(); 

    $kpost = Kpost::firstOrcreate([
      'post_id' => $post->id,
      'user_id' => auth()->id(),
      'sent_by' => auth()->id(),
      'sent_at' => Carbon::now() 
    ]);

    echo json_encode(array('success'=>true));
  }

  public function delete_contact_from_group(Post $post, Group $group)
  {
    $group->contacts()->detach($post->ref_id);
    echo json_encode(array('success'=>true));
  } 

  public function get_contacts()
  {
    $contacts = Contact
      ::join('users','contacts.user_ref','=','users.id')
      ->where("contacts.user_id","=",auth()->id())
      ->orderBy('users.name', 'asc')
      ->get();

    $data = [];

    foreach ($contacts as $contact)
    {
      $data[] = array(
          "id"=>$contact->user_ref,
          "name"=>$contact->name);
    }
    echo json_encode($data);
  }

  public function send_post(Request $request)
  { 
    $post = Post::find($request->get('post_id'));
    $selected = $request->get('selected');

    foreach ($selected as $user_id)
    {
      $kpost = Kpost::create([
        'post_id' => $post->id,
        'user_id' => $user_id,
        'sent_by' => auth()->id(),
        'sent_at' => Carbon::now() 
      ]);
    }

    echo json_encode(array('success'=>true));
  }

  /******************************************************
    Contacts tree
  *******************************************************/

  public function get_contacts_tree()
  {
    $groups = Group
      ::where("user_id","=",auth()->id())
      ->orderBy('name', 'asc')
      ->get();

    $data = [];

    $data[] = array(
          "id"=>0,
          "parent"=>"#",
          "text"=>"Todos");

    foreach ($groups as $group)
    {
      $parent = $group->parent_id;
      if (is_null($parent))
        $parent = "#";

      $data[] = array(
          "id"=>$group->id,
          "parent"=>$parent,
          "text"=>$group->name);
    }
    echo json_encode($data);
  }

  public function create_node(Request $request)
  {
    $id = $request->has('id') ? $request->get('id') : null;
    $id = $id !== '#' ? (int)($id) : null; 
    $text = $request->has('text') ? $request->get('text') : 'text';
    $text = $text !== '' ? $text : 'text';
    
    $group = new Group();
    $group->name = $text;
    $group->parent_id = $id;
    $group->user_id = auth()->id();
    $group->save();

    $result = array('id' => $group->id);
    echo json_encode($result);
  }

  public function rename_node(Request $request)
  {
    $id = $request->get('id'); 
    $text = $request->has('text') ? $request->get('text') : 'text';
    $text = $text !== '' ? $text : 'text';

    $group = Group::find($id);
    $group->name = $text;
    $group->save(); 
    $result = null;
    echo json_encode($result);  
  }

  public function delete_node(Request $request)
  {
    $id = $request->get('id');
    $group = Group::find($id);
    $delete = true;

    if ($group->parent_id == null)
    {
      $count = Group
      ::where("user_id","=",auth()->id())
      ->where("parent_id","=",null)
      ->count();
      if ($count == 1)
        $delete = false;
    }

    if($delete)
    {
      $group->delete();
      echo json_encode(array('success'=>true));
    }
    else
    {
      echo json_encode(array('msg'=>'Before eliminate this list you must create other.'));
    }
  }
}
