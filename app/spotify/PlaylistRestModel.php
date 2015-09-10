<?php

class PlaylistRestModel extends BaseProjectARestModel {
	
	public $id; #string (!)
	public $description; #string
	public $public; #bool
	public $tracks; #Track[]
	
	protected function insertEndpoint() {
		return new RestEndpoint(RestMethod.POST, sprintf('/v1/users/%s/playlists', SpotifyHelper::getUserId()));
	}
	
	protected function updateEndpoint() {
		return new RestEndpoint(RestMethod.PUT, sprintf('https://api.spotify.com/v1/users/%s/playlists/%s', SpotifyHelper::getUserId(), $this->id));
	}
	
}