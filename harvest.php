<?php

	$url      = "https://api.coinmarketcap.com/v1/ticker/lisk/" ;
	$data     = file_get_contents($url);
	$coindata = json_decode($data);

	$humanid          = $coindata[0]->id;
	$name             = $coindata[0]->name;
	$symbol           = $coindata[0]->symbol;
	$rank             = $coindata[0]->rank;
	$priceusd         = $coindata[0]->price_usd;
	$pricebtc         = $coindata[0]->price_btc;
	$marketcapusd     = $coindata[0]->market_cap_usd;
	$availablesupply  = $coindata[0]->available_supply;
	$totalsupply      = $coindata[0]->total_supply;
	$percentchange1h  = $coindata[0]->percent_change_1h;
	$percentchange24h = $coindata[0]->percent_change_24h;
	$percentchange7d  = $coindata[0]->percent_change_7d;
	$lastupdated      = $coindata[0]->last_updated;
	// $volume24h = $coindata[0]->24h_volume_usd;

	if (!empty($humanid)) {

		$server   = "localhost";
		$username = "{USRNAME}";
		$password = "{PASSWORD}";
		$dbname   = "{DBNAME}";

		$conn = new mysqli($server, $username, $password, $dbname);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "INSERT INTO `altcoin_item_lsk` (`id`, `humanid`, `name`, `symbol`, `rank`, `priceusd`, `pricebtc`, `volume24h`, `marketcapusd`, `availablesupply`, `totalsupply`, `percentchange1h`, `percentchange24h`, `percentchange7d`, `lastupdated`, `timestamp`) VALUES (NULL, '$humanid', '$name', '$symbol', '$rank', '$priceusd', '$pricebtc', '$volume24h', '$marketcapusd', '$availablesupply', '$totalsupply', '$percentchange1h', '$percentchange24h', '$percentchange7d', '$lastupdated', CURRENT_TIMESTAMP);";

		if ($conn->query($sql) === TRUE) {
			echo "Harvest to DB successful";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();

	}
