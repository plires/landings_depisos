<?php 

//////////////////////////////////////////////////////////////////////
///Copias de los mensajes
//////////////////////////////////////////////////////////////////////
define('EMAIL_BCC_MARTIN', 'martin@superfil.com.ar');
define('NAME_BCC_MARTIN', 'Martin Calcagno');

//////////////////////////////////////////////////////////////////////
///Casillas con datos
//////////////////////////////////////////////////////////////////////
define('ELEONORA', array(
    'eleonora@depisos.com', 
    'Eleonora', 
    'https://api.whatsapp.com/send/?phone=5491153117118&text=Hola%20Eleonora!%20Necesito%20hacer%20una%20consulta!&app_absent=0', 
    '11-5311-7118'
));

define('ABIGAIL', array(
    'abigail@depisos.com', 
    'Abigail', 
    'https://api.whatsapp.com/send/?phone=5491157048089&text=Hola%20Abigail!%20Necesito%20hacer%20una%20consulta!&app_absent=0', 
    '11-5704-8089'
));

define('BARBARA', array(
    'barby@depisos.com', 
    'Barbara', 
    'https://api.whatsapp.com/send/?phone=5491141711995&text=Hola%20Barbara!%20Necesito%20hacer%20una%20consulta!&app_absent=0', 
    '11-4171-1995'
));

define('NOELIA', array(
    'noelia@depisos.com', 
    'Noelia', 
    'https://api.whatsapp.com/send/?phone=5491158065211&text=Hola%20Noelia!%20Necesito%20hacer%20una%20consulta!&app_absent=0', 
    '11-5806-5211'
));

define('AGUSTIN', array(
    'agustin@depisos.com', 
    'Agustin', 
    'https://api.whatsapp.com/send/?phone=5491123688587&text=Hola%20Agustin!%20Necesito%20hacer%20una%20consulta!&app_absent=0', 
    '11-2368-8587'
));

define('MARTIN_C', array(
    'martin@superfil.com.ar', 
    'Martin', 
    'https://api.whatsapp.com/send/?phone=5491131861400&text=Hola%20Martin!%20Necesito%20hacer%20una%20consulta!&app_absent=0', 
    '11-3186-1400'
));

//////////////////////////////////////////////////////////////////////
/// Rotatividad de casillas segun rubros
//////////////////////////////////////////////////////////////////////
define('EMAIL_VENTAS_GRIFERIAS', array( AGUSTIN, ABIGAIL, BARBARA ));
define('EMAIL_VENTAS_CERAMICOS', array( ABIGAIL, BARBARA ));
define('EMAIL_VENTAS_PISOS', array( ABIGAIL, BARBARA ));
define('EMAIL_VENTAS_PORCELANATOS', array( ABIGAIL, BARBARA ));
define('EMAIL_VENTAS_DECKS', array( ABIGAIL, ELEONORA, BARBARA ));
define('EMAIL_VENTAS_REVESTIMIENTOS', array( ABIGAIL, ELEONORA, BARBARA ));
define('EMAIL_VENTAS_TETO', array( ABIGAIL ));
define('EMAIL_DEFAULT', array( MARTIN_C ));

?>