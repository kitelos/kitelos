<?php
namespace App\Helpers;

use Illuminate\Support\Collection;

class Helper {

	public function generatePermissions() {
		$modules = config('seguce92.permission.modules');
        $messages = config('seguce92.permission.messages');
		$translations = config('seguce92.permission.translation');
		$names = config('seguce92.permission.names');

		$now = \Carbon\Carbon::now();
		$keys =  array_keys($modules);
		$data = collect([]);

		$m_permission = app(\App\Entities\Core\Permission::class);
		
		foreach($keys as $module) {
			foreach($modules[$module] as $row) {
				$trans = explode('|', $translations[$module]);
				$slug = $module.'.'.$row;

				if($m_permission->where('slug', $slug)->count() === 0) {
					$permission = collect([
						'name'	=>	$names[$row],
						'slug'	=>	$slug,
						'description'	=>	str_contains($messages[$row], '?s') ? str_replace('?s', $trans[0], $messages[$row]) : str_replace('?p', $trans[1], $messages[$row]),
						'model'	=>	$trans[1],
						'created_at'	=>	$now->toDateTimeString(),
						'updated_at'	=>	$now->toDateTimeString()
					]);

					$data->push($permission);
				}
			}
		}

		return $data->toArray();
	}

	public function parseBoolean ($value) {
		return $value == 'true' ? 1 : 0;
	}

	public function permiss ($permission) {
		if ( in_array($permission, \Auth::user()->rules->toArray()) )
			return true;
		
		return abort(403, 'not_permission');
	}

}
