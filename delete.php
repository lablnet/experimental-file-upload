<?php 

// check if uploads directory exists.
if ( file_exists( 'uploads' ) ) {
    // delete it recursively.
    rmdir( 'uploads', true );
}