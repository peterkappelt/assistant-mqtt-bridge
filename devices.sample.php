<?php

$devices = [];

//a new device is added like this
$devices[] = [
    //an unique id for this device
    'id' => 'testdev1',
    //The type of this virtual device. See https://developers.google.com/actions/smarthome/guides/
    'type' => 'action.devices.types.LIGHT',
    //Available traits (features, functions) of this device. See https://developers.google.com/actions/smarthome/traits/. Not all are supported yet
    'traits' => [
        'action.devices.traits.Brightness',
        'action.devices.traits.OnOff'
    ],
    //Primary name for this device, that Google Assitant will listen to
    'name' => 'Testgerät',
    //additional names
    'nicknames' => [
        'Testlampe'
    ]
];

$devices[] = [
    'id' => 'testdev2',
    'type' => 'action.devices.types.OUTLET',
    'traits' => [
        'action.devices.traits.OnOff'
    ],
    'name' => 'Steckdose',
    'nicknames' => [
        'Steckdose Eins'
    ]
];

?>