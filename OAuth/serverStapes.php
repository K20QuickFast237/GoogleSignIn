<?php



//#  FOR OAUTH2.0 Configuration with googleAPI 

// Step 1:
    // Create a state token to prevent request forgery.
    // Store it in the session for later validation.
    $state = bin2hex(random_bytes(128/8));
    $app['session']->set('state', $state);
    // Set the client ID, token state, and application name in the HTML while
    // serving it.
    return $app['twig']->render('index.html', array(
        'CLIENT_ID' => 123,
        'STATE' => $state,
        'APPLICATION_NAME' => 'the name'
    ));

//step 2: Confirmer le jeton d'état contre la falsification
    // Ensure that there is no request forgery going on, and that the user
    // sending us this connect request is the user that was supposed to.
    if ($request->get('state') != ($app['session']->get('state'))) {
        return new Response('Invalid state parameter', 401);
    }