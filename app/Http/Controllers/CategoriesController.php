<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Page;

class CategoriesController extends Controller
{
  public function show_category(Category $category)
  {
  	$catalogs = $category->catalogs()->paginate(2);
  	return view('categories.show_category',compact('category','catalogs'));
  }

  //****************************************************
  // Categories Tree
  //****************************************************

  public function get_categories_tree(Page $page)
  {
    $categories = Category
      ::where("page_id","=",$page->id)
      ->orderBy('name', 'asc')
      ->get();

    $data = [];
    foreach ($categories as $category)
    {
      $parent = $category->parent_id;
      if (is_null($parent))
        $parent = "#";

      $data[] = array(
          "id"=>$category->id,
          "parent"=>$parent,
          "text"=>$category->name);
    }
    echo json_encode($data);
  }

  public function create_node(Request $request)
  {
    $id = $request->has('id') ? $request->get('id') : null;
    $id = $id !== '#' ? (int)($id) : null; 
    $text = $request->has('text') ? $request->get('text') : 'text';
    $text = $text !== '' ? $text : 'text';
    $page_id = $request->get('page_id');
    
    $cat = new Category();
    $cat->name = $text;
    $cat->parent_id = $id;
    $cat->page_id = $page_id;
    $cat->save();

    $result = array('id' => $cat->id);
    echo json_encode($result);
  }

  public function rename_node(Request $request)
  {
    $id = $request->get('id'); 
    $text = $request->has('text') ? $request->get('text') : 'text';
    $text = $text !== '' ? $text : 'text';

    $cat = Category::find($id);
    $cat->name = $text;
    $cat->save(); 
    $result = null;
    echo json_encode($result);  
  }

  public function delete_node(Request $request)
  {
    $id = $request->get('id');
    $cat = Category::find($id);
    $page_id = $cat->page_id;
    $delete = true;

    if ($cat->parent_id == null)
    {
      $count = Category
      ::where("page_id","=",$page_id)
      ->where("parent_id","=",null)
      ->count();
      if ($count == 1)
        $delete = false;
    }

    if($delete)
    {
      $cat->delete();
      echo json_encode(array('success'=>true));
    }
    else
    {
      echo json_encode(array('msg'=>'Antes de eliminar esta categoría debe crear otra.'));
    }
  }
}
