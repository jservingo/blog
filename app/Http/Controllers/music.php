      $url_artist = "http://musicbrainz.org/ws/2/artist/".$mbid."?inc=url-rels";
      
      $curl = curl_init();
      curl_setopt_array($curl, Array(
        CURLOPT_URL            => $url_artist,
        CURLOPT_USERAGENT      => "Kodelia/1.0 (jservingo@gmail.com)",
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_ENCODING       => 'UTF-8'
      ));      
      $data = curl_exec($curl);
      curl_close($curl);

      if ($data[0] == "<") {
        $xml = simplexml_load_string($data);
        
        $links_artist = $xml->{'artist'}->{'relation-list'};
        foreach($links_artist->children() as $link) {
          $links = $links."<a href='".$link->target."' target='_blank'>".$link->attributes()->{'type'}."</a> ";
          if ($link->attributes()->{'type'} == "image")
            $url_image = $link->{'target'}; 
        }

        /*
        if ($url_image != "")
          $img = get_post_image($url_image);
        */
      }
