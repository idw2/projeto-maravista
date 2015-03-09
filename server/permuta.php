<?php


function permutations( array $array, $key = 0, $limit = 8 )
{
	static $result;
	$count = count( $array );
	
	try
	{
		if( $count > $limit )
		{
			throw new LengthException( sprintf( 'Error!: Unable to generate permutations with more than %d values' , $limit ) );
		}
		
		if( $key == $count )
		{
			$result[ ] = $array;
		}
		else
		{
			for( $i = $key; $i < $count; $i++ )
			{
				list( $array[ $key ], $array[ $i ] ) = array( $array[ $i ], $array[ $key ] );
				permutations( $array, $key + 1 );
			}
		}
		
		return $result;
	}
	catch( LengthException $e )
	{
		echo $e->getMessage( );
	}
}

echo '<pre>';
print_r( permutations( array( 'A' , 1 , 'B' , 2 , 'C' , 3 ) ) ); 


?>