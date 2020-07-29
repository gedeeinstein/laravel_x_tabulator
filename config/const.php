<?php

/*
  |--------------------------------------------------------------------------
  | This config file contains common constants for the whole project
  | For example success / error message for CRUD
  |--------------------------------------------------------------------------
 */

return [

    // Common message
    'SUCCESS_CREATE_MESSAGE' => 'Created Content was save',        // success when data created
    'FAILED_CREATE_MESSAGE'  => 'Failed to save the Created Content', // failed when data created
    'SUCCESS_UPDATE_MESSAGE' => 'Edited Content was saved.',        // success when data updated
    'FAILED_UPDATE_MESSAGE'  => 'Failed to save the Edited Content', // failed when data updated
    'SUCCESS_DELETE_MESSAGE' => 'Content was Deleted',        // success when data deleted
    'FAILED_DELETE_MESSAGE'  => 'Failed to Delete Content', // failed when data deleted
    'FAILED_DELETE_SELF_MESSAGE'  => 'Failed to Delete Current User', // failed when data deleted
];
