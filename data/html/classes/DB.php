<?php 

    require_once 'vendor/autoload.php';

    use GraphAware\Neo4j\Client\ClientBuilder;

	class Neo4 {

        var $client;


        function __construct ($file) {
            
            include ($file);

            $this ->client = ClientBuilder::create()
            ->addConnection('default', 'http://'. DB_USER .':'. DB_PASSWD .'@'. DB_HOST .':'.DB_HTTP_PORT) // Example for HTTP connection configuration (port is optional)
            ->addConnection('bolt', 'bolt://'. DB_USER .':'. DB_PASSWD .'@'. DB_HOST .':'. DB_BOLT_PORT) // Example for BOLT connection configuration (port is optional)
            ->build();               
        }

        function getNumFriends () {

            $query = "MATCH (n:Person)-[:FOLLOWS]->(friend) RETURN n.name, collect(friend) as friends";
            $result = $this->client->run($query);

            return $result;
        
        }

	}
?>