<?php
try {
	$dbh = new PDO( 'mysql:host=localhost;dbname=WordList',
				'3342user', 'temp1234',
				array( PDO::ATTR_PERSISTENT => true ) );

    # make sure we get db errors!
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch( PDOException $e ) {
	print "ERROR: ".$e->getMessage();
}
?>