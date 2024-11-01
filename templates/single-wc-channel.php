<?php header('Content-Type: application/xml; charset=utf-8'); ?>
<?php include(plugin_dir_path(__FILE__) . 'channel-data.php'); ?>

<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:atom="http://www.w3.org/2005/Atom" version="2.0" xmlns:googleplay="http://www.google.com/schemas/play-podcasts/1.0">
	<channel>
<?php if($channel_meta['blocked']) : ?>
			
			<googleplay:block>yes</googleplay:block>
			<itunes:block>yes</itunes:block>
<?php endif; //BLOCKED ?>
		
		<title><?php echo $channel_meta['title']; ?></title>
		
<?php if($channel_meta['link']) : ?>
		
		<link><?php echo $channel_meta['link']; ?></link>
<?php else : ?>
		<link><?php echo get_site_url(); ?></link>
<?php endif; ?>
  
		<image>
			<url><?php echo $channel_meta['image']; ?></url>
			<title><?php echo $channel_meta['title']; ?></title>
<?php if($channel_meta['link']) : ?>
		
			<link><?php echo $channel_meta['link']; ?></link>
<?php else : //LINK ?>
			<link><?php echo get_site_url(); ?></link>
<?php endif; //LINK ?>

		</image>
		<googleplay:image href="<?php echo $channel_meta['image']; ?>" />
		<itunes:image href="<?php echo $channel_meta['image']; ?>"/>
		<googleplay:description>
			<?php echo $channel_meta['description'] . "\n"; ?>
		</googleplay:description>
		<itunes:summary>
			<?php echo $channel_meta['description'] . "\n"; ?>
		</itunes:summary>
		<description>
			<?php echo $channel_meta['description'] . "\n"; ?>
		</description>
		<language><?php echo $channel_meta['language']; ?></language>
<?php if($channel_meta['copyright']) : ?>

		<copyright><?php echo $channel_meta['copyright']; ?></copyright>
<?php endif; //COPYRIGHT ?>

		<atom:link href="<?php echo get_the_permalink(); ?>" rel="self" type="application/rss+xml"/>
 		<lastBuildDate><?php echo $channel_meta['modified']['string']; ?></lastBuildDate>
		<googleplay:author><?php echo $channel_meta['author']; ?></googleplay:author>
		<itunes:author><?php echo $channel_meta['author']; ?></itunes:author>
		<itunes:subtitle>
			<?php echo $channel_meta['subtitle'] . "\n"; ?>
		</itunes:subtitle>
		<googleplay:email><?php echo $channel_meta['owner_mail']; ?></googleplay:email>
		<itunes:owner>
			<itunes:name><?php echo $channel_meta['owner']; ?></itunes:name>
			<itunes:email><?php echo $channel_meta['owner_mail']; ?></itunes:email>
		</itunes:owner>
		<googleplay:explicit><?php echo $channel_meta['explicit']; ?></googleplay:explicit>
		<itunes:explicit><?php echo $channel_meta['explicit']; ?></itunes:explicit>
<?php
	if($channel_meta['categories']){
				echo $channel_meta['categories'];
	}
?>

		<itunes:type><?php echo $channel_meta['type']; ?></itunes:type>
		<pubDate><?php echo get_the_date("D, d M Y H:i:s T"); ?></pubDate>
<?php foreach($channel_content as $episode) : ?>
<?php //ITEM ITEM ITEM ITEM ITEM ITEM ?>

		<item>
<?php if($episode['blocked']) : ?>
			
			<googleplay:block>yes</googleplay:block>
			<itunes:block>yes</itunes:block>
<?php endif; //BLOCKED ?>
			
			<title><?php echo $episode['title']; ?></title>
			<link>
				<?php echo $episode['file_url'] . "\n"; ?>
			</link>
			<pubDate><?php echo $episode['pub_date']; ?></pubDate>
			<googleplay:description>
				<?php echo $episode['description'] . "\n"; ?>
			</googleplay:description>
			<itunes:summary>
				<?php echo $episode['description'] . "\n"; ?>
			</itunes:summary>
			<description>
				<?php echo $episode['description'] . "\n"; ?>
			</description>
			<itunes:subtitle><?php echo $episode['subtitle']; ?></itunes:subtitle>
			<enclosure url="<?php echo $episode['file_url']; ?>" length="<?php echo $episode['length']; ?>" type="<?php echo $episode['mime_type']; ?>"/>
			<guid>
				<?php echo $episode['file_url'] . 'ID' . $episode['ID']; ?>
			</guid>
			<itunes:title><?php echo $episode['title']; ?></itunes:title>
			<itunes:duration><?php echo $episode['duration']; ?></itunes:duration>
			<googleplay:explicit><?php echo $episode['explicit']; ?></googleplay:explicit>
			<itunes:explicit><?php echo $episode['explicit']; ?></itunes:explicit>
			<itunes:episodeType><?php echo $episode['episode_type']; ?></itunes:episodeType>
<?php if($episode['season']) : ?>

			<itunes:season><?php echo $episode['season']; ?></itunes:season>
<?php endif; //SEASON ?>
<?php if($episode['episode_number']) : ?>

			<itunes:episode><?php echo $episode['episode_number']; ?></itunes:episode>
<?php endif; //EPISODE NUMBER ?>
<?php if($episode['image']) : ?>

			<itunes:image href="<?php echo $episode['image']; ?>"/>
<?php endif; //IMAGE ?>
<?php if($episode['keywords']) : ?>

			<itunes:keywords>
				<?php echo $episode['keywords'] . "\n"; ?>
			</itunes:keywords>
<?php endif; //KEYWORDS ?>
<?php
	if($episode['categories']){
				echo $episode['categories'];
	}
?>
		</item>
<?php endforeach; ?>

	</channel>
</rss>
