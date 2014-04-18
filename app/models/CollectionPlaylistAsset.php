<?php

/**
 * An Eloquent Model: 'CollectionPlaylistAsset'
 *
 * @property integer $id
 * @property integer $collection_id
 * @property integer $playlist_id
 * @property integer $asset_id
 */
class CollectionPlaylistAsset extends Eloquent {
	protected $guarded = array();
	protected $table = 'collection_playlist_asset';
	public static $rules = array();
	public $timestamps = false;


// 	public function add($collection_id,$playlist_id,$asset_id)
// 	{

//                 // $playlist_id = $playlist_id == null ? $playlist_id : 0;

// 		$cpa = DB::table('collection_playlist_asset')->insert(
// 			array(
// 				'collection_id' => $collection_id,
// 				'playlist_id' => $playlist_id,
// 				'asset_id' => $asset_id,
// 				)
// 			);

// 	}

//     public function deleteByAsset($assetId){
//         // Find the all cpa with asset id

//         //delete all found


// //        DB::table('collection_playlist_asset')->delete(
// //            array(
// //                'collection_id' => $collection_id,
// //                'playlist_id' => $playlist_id,
// //                'asset_id' => $asset_id,
// //            )
// //        );
//     }

//     public function update_asset_order($cpaKey,$order_id){

//     }



// 	public function get_cpa_by_user_id($id)
// 	{
// 		$data =  DB::select(DB::raw("SELECT
// 			collection_playlist_asset.id,
// 			collection_playlist_asset.collection_id,
// 			collection_playlist_asset.playlist_id,
// 			collection_playlist_asset.asset_id,
// 			collection_playlist_asset.asset_order

// 			FROM collection_playlist_asset

// 			LEFT JOIN asset_user
// 			ON collection_playlist_asset.asset_id = asset_user.asset_id
// 			WHERE asset_user.user_id = $id
// 			ORDER BY    collection_playlist_asset.collection_id ASC,
// 						collection_playlist_asset.playlist_id ASC,
// 						collection_playlist_asset.asset_order ASC"));

// 		// return $data;
// 		if (count($data) == 0){
// 			return array("results" => 0, "description"=>"No Results returned", "user" =>User::find($id) ? User::find($id)->id:null);
// 		}

// 		$cpa = (Object) array();
// 		// $cpa->user_id = $id;
// 		// return json_encode($data);
// 		foreach ($data as $key => $v) {
// 			// return json_encode($v->collection_id. " ".$v->playlist_id ." ".$v->asset_id ." ".$v->asset_order .  " " . Playlist::find($v->playlist_id)['name']);
// 			// return json_encode($v);
// 			// collection
// 			// var_dump($v->collection_id);
// 			if (!property_exists($cpa, "collections") ) {
// 					$cpa->collections = array();
// 				}
// 			if (!array_key_exists($v->collection_id, $cpa->collections)) {
// 				$cpa->collections[$v->collection_id] = new stdClass();
// 				//$cpa->collections[$v->collection_id]->name = Collection::find($v->collection_id)['name'];

// 				$tmp = Collection::find($v->collection_id);
// 				$cpa->collections[$v->collection_id]->name = $tmp['name'];

// 				$cpa->collections[$v->collection_id]->id = Collection::find($v->collection_id)['id'];
// 			}


// 			//Playlist
// 			if ($v->playlist_id) {
// 				// if playlist
// 				if (!property_exists($cpa->collections[$v->collection_id], "playlists") ) {
// 					$cpa->collections[$v->collection_id]->playlists = array();
// 				}
// 				if (!array_key_exists($v->playlist_id, $cpa->collections[$v->collection_id]->playlists)) {
// 					$cpa->collections[$v->collection_id]->playlists[$v->playlist_id] = new stdClass();
// 				}
// 				// echo"<pre>";
// 				// print_r($cpa);
// 				// var_dump(json_encode($cpa->collections[$v->collection_id]->playlists[$v->playlist_id])  ." ". Playlist::find($v->playlist_id)['name']  ." ". $v->playlist_id);

// 				$cpa->collections[$v->collection_id]->playlists[$v->playlist_id]->id = $v->playlist_id;
// 				$cpa->collections[$v->collection_id]->playlists[$v->playlist_id]->name = Playlist::find($v->playlist_id)['name'];
// 				$cpa->collections[$v->collection_id]->playlists[$v->playlist_id]->description = Playlist::find($v->playlist_id)['description'];
// 				// end if playlist
// 			}
// 			else{
// 				// if asset not playlist its an asset
// 				if (!property_exists($cpa->collections[$v->collection_id], "assets") ) {
// 					$cpa->collections[$v->collection_id]->assets = array();
// 				}
// 				if (!array_key_exists($v->asset_id, $cpa->collections[$v->collection_id]->assets)) {
// 					$cpa->collections[$v->collection_id]->assets[$v->asset_id] = new stdClass();
// 				}

// 				$cpa->collections[$v->collection_id]->assets[$v->asset_id] = new stdClass;
// 				$cpa->collections[$v->collection_id]->assets[$v->asset_id]->id = $v->asset_id;
// 				$cpa->collections[$v->collection_id]->assets[$v->asset_id]->name = Asset::find($v->asset_id)['title'];
// 				$cpa->collections[$v->collection_id]->assets[$v->asset_id]->description = Asset::find($v->asset_id)['description'];
// 				// end if asset not playlist
// 			}



// 			// Playlist Assets
// 			// var_dump($v->playlist_id);
// 			if ($v->playlist_id) {
// 				$cpa->collections[$v->collection_id]->playlists[$v->playlist_id]->assets[$v->asset_id] = new stdClass;
// 				$cpa->collections[$v->collection_id]->playlists[$v->playlist_id]->assets[$v->asset_id]->id = $v->asset_id;
// 				$cpa->collections[$v->collection_id]->playlists[$v->playlist_id]->assets[$v->asset_id]->name = Asset::find($v->asset_id)['title'];
// 				$cpa->collections[$v->collection_id]->playlists[$v->playlist_id]->assets[$v->asset_id]->description = Asset::find($v->asset_id)['description'];
// 			}else{
// 				// var_dump("oops");
// 			}



// 		}


// // return $cpa;
// // 		die();
// 		$collections = current($cpa);
// 		if (count($collections) && is_array($collections)) {
// 			return array_values($collections);
// 		}

// 	}
}

