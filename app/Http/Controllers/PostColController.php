<?php

namespace App\Http\Controllers;

use DB;

class PostColController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function index()
    {
        return view('pages.collections', ['title' => 'collections']);
    }

    public static function insertCollection()
    {
        $test = DB::table('collection')->insertGetId(['name' => $_POST['data']['name'], 'description' => $_POST['data']['description']]);

        return $test;
    }

    public static function insertCol()
    {
        foreach ($_POST['data'] as $col) {
            DB::table('collection_item')->insert([
                'ext_id' => $col['col_id'],
                'int_id' => $col['id'],
                'collection_id' => $_POST['id_col'],
                'name' => $col['name'],
                'description' => $col['description'],
                'parrent_id' => $col['parent'],
            ]);

            return;
        }
    }

    public static function insertRequest()
    {
        foreach ($_POST['data'] as $request) {
            DB::table('request')->insert([
                'int_id' => $request['id'],
                'name' => $request['name'],
                'ext_id' => $request['request_id'],
                'description' => $request['description'],
                'collection_id' => $_POST['id_col'],
                'collection_item_id' => $request['parent'],
                'methode' => $request['methode'],
                'url_raw' => $request['url'],
                'url_protocol' => $request['url_protocol'] ?? '',
            ]);
        }
    }

    public static function insertheaders()
    {
        foreach ($_POST['data'] as $request) {
            DB::table('request_header')->insert([
                'collection_id' => $_POST['id_col'],
                'request_id' => $request['request_id'],
                'key' => $request['key'],
                'value' => $request['value'],
            ]);
        }
    }

    public static function insertEnv()
    {
        foreach ($_POST['data'] as $request) {
            DB::table('collection_env')->insert([
                'collection_id' => $_POST['id_col'],
                'key' => $request['key'],
                'value' => $request['value'],
            ]);
        }
    }
}
