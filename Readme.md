# PHPebbleTimeline

## About

PHPebbleTimeline is a library for making use the Timeline API through PHP.

## Requirements

PHP 5.3 or Higher installed with [cURL](http://php.net/manual/en/curl.installation.php)

##  Setup

Ensure your application is setup to use [Pebble Timeline](http://developer.getpebble.com/guides/timeline/timeline-enabling/)

Copy the `TimelineAPI` Folder to your project's directory.

Require the TimelineAPI in your project:

```php
require_once 'PATH/TO/API/Timeline.php';
```

## Creating and Customizing Pins - Objects

### Pin Object

A `Pin` object represents the [Timeline Pin](http://developer.getpebble.com/guides/timeline/pin-structure/#pin-overview) which will be pushed to the watch.

To create a pin object be sure to use the Pin class

```php
use TimelineAPI\Pin;
```
A `Pin` Object accepts the following parameters

| Name                 | Type               | Argument   | Default   | Description                                                              |
| ----                 | :----:             | :--------: | --------- | -------------                                                            |
| `id`                 | string             | (required) |           | The ID that represents the pin                                           |
| `time`               | DateTime           | (required) |           | The UTC Datetime of the event                                            |
| `layout`             | [PinLayout]        | (optional) | null      | The description of the values of the pin                                 |
| `duration`           | int                | (optional) | null      | The duration of the event, in minutes                                    |
| `createNotification` | [PinNotification]  | (optional) | null      | The notification the users sees when the pin is created                  |
| `updateNotification` | [PinNotification]  | (optional) | null      | The notification the user sees when the pin is already on their Timeline |

Here is an example pin using a very generic [PinLayout]:

````php
// Create the layout object for our pin
$genericLayout = new PinLayout(PinLayoutType::GENERIC_PIN, 'MY PIN TITLE', null, null, null, PinIcon::NOTIFICATION_FLAG);

//Create an instance of our pin
$pin = new Pin('MY-SAMPLE-PIN', (new DateTime('now')) -> now(new DateInterval('PT30M')), $genericLayout);
````

##### getID()

`getID` returns the string representation of your pin's ID.

````php
//Returns 'MY-SAMPLE-PIN' for the above sample pin
$pin -> getID();
````

##### addReminder([PinReminder] reminder)

`addReminder` adds a [PinReminder] to the `Pin` object. A maximum of 3 [PinReminder] objects can be added.

Returns `true` if the reminder was added; otherwise `false`

````php
//Create the layout of the reminder
$reminderlayout = new PinLayout(PinLayoutType::GENERIC_REMINDER, 'Sample reminder!', null, null, null, PinIcon::NOTIFICATION_FLAG);

//Create the reminder objects
$reminderOne = new PinReminder($reminderlayout, (new DateTime('now')) -> now(new DateInterval('PT10M'))); // 20 mins before the sample event
$reminderTwo = new PinReminder($reminderlayout, (new DateTime('now')) -> now(new DateInterval('PT20M'))); // 10 mins before the sample event
...
$reminderFour = new PinReminder($reminderlayout, (new DateTime('now')) -> now(new DateInterval('PT28M'))); // 2 mins before the sample event

//Add the reminder objects
$pin -> addReminder($reminderOne); //returns true and is added
$pin -> addReminder($reminderTwo); //returns true and is added
...
$pin -> addReminder($reminderFour); //returns false and is not added
````

##### addAction([PinAction] action)

`addAction` adds a [PinAction] to the `Pin` object. This action will be attached to the pin on the watch

````php

//Create the PinAction objects
$actionOne = new PinAction('RSVP Yes', 1, PinActionType::OPEN_WATCH_APP); // Pin action to reply yes
$actionOne = new PinAction('RSVP No', 2, PinActionType::OPEN_WATCH_APP); // Pin action to reply no

//Add the reminder objects
$pin -> addAction($actionOne);
$pin -> addAction($actionOne);
````

##### getData()

`getData` returns an associative array of the pin's data

````php
//Returns an array object representing all of the data added to our sample pin
$pin -> getData();
````

### Layout Object

A `PinLayout` object represents the [Layout Object](http://developer.getpebble.com/guides/timeline/pin-structure/#layout-object) which determine the styles of any views regarding your [Pin] on the Timeline.

To create a layout object be sure to use the `PinLayout` class

```php
use TimelineAPI\PinLayout;
```
A `PinLayout` Object accepts the following parameters. Note that some optional parameters are required by certain [PinLayoutTypes]. More information available here: [Layout Type](http://developer.getpebble.com/guides/timeline/pin-structure/#pin-layouts)

| Name                  | Type              | Argument   | Default   | Description                                                                  |
| ----                  | :----:            | :--------: | --------- | -------------                                                                |
| `type`                | [PinLayoutType]   | (required) |           | The type of pin being displayed                                              |
| `title`               | string            | (optional) | null      | The main title of the pin when viewed                                        |
| `shorttitle`          | string            | (optional) | null      | The title of the pin in a compressed view                                    |
| `subtitle`            | string            | (optional) | null      | Shorter subtitle for the detailed view                                       |
| `body`                | string            | (optional) | null      | The notification the users sees when the pin is created                      |
| `tinyicon`            | [PinIcon]         | (optional) | null      | The pin's tiny icon                                                          |
| `smallicon`           | [PinIcon]         | (optional) | null      | The pin's small icon                                                         |
| `largeicon`           | [PinIcon]         | (optional) | null      | The pin's large icon                                                         |
| `foregroundColor`     | [PebbleColor]     | (optional) | null      | The main color of the pin                                                    |
| `backgroundColor`     | [PebbleColor]     | (optional) | null      | The background color of the pin                                              |
| `headings`            | Array             | (optional) | null      | The text headings of the pin. The amount must match the amount of paragraphs |
| `paragraphs`          | Array             | (optional) | null      | The text sections of the pin. The amount must match the amount of headings   |
| `lastupdated`         | DateTime          | (optional) | null      | The timestamp of when the pin's data (e.g. Weather forecast) was last updated|
| `specialAttributes`   | Array             | (optional) | null      | Any special attributes that the speicifc layout may have. (e.g. sports score)|

Here is an example pin using a very generic [PinLayout]:

````php
// Create the layout object for our pin
$genericLayout = new PinLayout(PinLayoutType::GENERIC_PIN, 'MY PIN TITLE', null, null, null, PinIcon::NOTIFICATION_FLAG);
````

##### getData()

`getData` returns an associative array of the [PinLayout]'s data

````php
//Returns an array object representing all of the data added to our sample pin
$genericLayout -> getData();
````

### Notification Object

A `PinNotification` object represents the [Notification Object](http://developer.getpebble.com/guides/timeline/pin-structure/#notification-object) which will notify the user when a [Pin] changes status (created, updated).

To create a layout object be sure to use the `PinNotification` class

```php
use TimelineAPI\PinNotification;
```
A `PinNotification` Object accepts the following parameters.

| Name                  | Type              | Argument   | Default   | Description                                                                  |
| ----                  | :----:            | :--------: | --------- | -------------                                                                |
| `layout`              | [PinLayout]       | (required) |           | The layout of the notification which will be view by the user                |
| `time`                | DateTime          | (optional) | null      | The time the update was received                                             |

Here is an example notification.

````php
$notificationLayout = new PinLayout(PinLayoutType::GENERIC_PIN, 'Pin updated', null, null, null, PinIcon::NOTIFICATION_FLAG);
$notification = new PinNotification($notificationLayout, new DateTime('now'));
````

##### getData()

`getData` returns an associative array of the [PinNotification]'s data

````php
$notification -> getData();
````

### Reminder Object

A `PinReminder` object represents the [Reminder Object](http://developer.getpebble.com/guides/timeline/pin-structure/#reminder-object) which will send a reminder to the user at a specific time.

To create a reminder object be sure to use the `PinReminder` class

```php
use TimelineAPI\PinReminder;
```
A `PinReminder` Object accepts the following parameters.

| Name                  | Type              | Argument   | Default   | Description                                                                  |
| ----                  | :----:            | :--------: | --------- | -------------                                                                |
| `layout`              | [PinLayout]       | (required) |           | The layout of the notification which will be view by the user                |
| `time`                | DateTime          | (optional) | null      | The time the update was received                                             |

Here is an example reminder.

````php
$reminderlayout = new PinLayout(PinLayoutType::GENERIC_REMINDER, 'Sample reminder!', null, null, null, PinIcon::NOTIFICATION_FLAG);
$reminder = new PinReminder($reminderlayout, new DateTime('now')); //send the reminder right away
````

##### getData()

`getData` returns an associative array of the [PinReminder]'s data

````php
$reminder -> getData();
````


### Action Object

A `PinAction` object represents the [Action Object](http://developer.getpebble.com/guides/timeline/pin-structure/#action-object) which determine any actions your [Pin] may perform while on the Timeline.

To create an action object be sure to use the `PinAction` class

```php
use TimelineAPI\PinAction;
```
A `PinAction` Object accepts the following parameters.

| Name                  | Type              | Argument   | Default   | Description                                                                  |
| ----                  | :----:            | :--------: | --------- | -------------                                                                |
| `title`               | String            | (required) |           | The action title to be displayed in the pin's menu                           |
| `launchcode`          | int               | (required) |           | The code to send your app when opening via this action                       |
| `type`                | [PinActionType]   | (required) |           | The type of action being performed                                           |

Here is an example of a RSVP [PinAction]:

````php
$action = new PinAction('RSVP Yes', 1, PinActionType::OPEN_WATCH_APP); // Pin action to reply yes
````

##### getData()

`getData` returns an associative array of the [PinAction]'s data

````php
//Returns an array object representing all of the data added to our action
$action -> getData();
````

## Creating and Customizing Pins - Constants

### PinLayoutType Constant
A `PinLayoutType` constant represents the [Layout Types](http://developer.getpebble.com/guides/timeline/pin-structure/#pin-layouts) that are available. See [available layouts](docs/PinLayoutTypes.md) for a list of all layout types supported. (If a layout is missing please let me know via the issue tracker!)

To retrieve layout types be sure to use the `PinLayoutType` class

```php
use TimelineAPI\PinLayoutType;
```

The following code will get the layout type for a sports pin.

````php
$layoutType = PinLayoutType::SPORTS_PIN;
````

### PinIcon Constant

A `PinIcon` constant represents the [Pin Icons](http://developer.getpebble.com/guides/timeline/pin-structure/#pin-icons) available. See [available icons](docs/PinIcons.md) for a list of all icons supported. (If an icon is missing please let me know via the issue tracker!)

To retrieve pin icons be sure to use the `PinIcon` class

```php
use TimelineAPI\PinIcon;
```

The following code will get the URI for a Notification flag.

````php
$icon = PinIcon::NOTIFICATION_FLAG;
````

### PebbleColor Constant

A `PebbleColor` constant represents the [Pebble Colors](http://developer.getpebble.com/tools/color-picker/) that are available. See [available colors](docs/PebbleColors.md) for a list of all colors supported. (If a color is missing please let me know via the issue tracker!)

To retrieve colors be sure to use the `PebbleColor` class

```php
use TimelineAPI\PebbleColor;
```

The following code will get the color code for red.

````php
$color = PebbleColor::RED;
````

### PinActionType Constant

A `PinActionType` constant represents the [Pin Actions](http://developer.getpebble.com/guides/timeline/pin-structure/#pin-actions) that are available. See [available action types](docs/PinActionTypes.md) for a list of all actions supported. (If an action is missing please let me know via the issue tracker!)

To retrieve actions be sure to use the `PinActionType` class

```php
use TimelineAPI\PinActionType;
```

The following code will get the open action type.

````php
$actionType = PinActionType::OPEN_WATCH_APP;
````

## Pushing, Updating and Deleting Pins

### Timeline Functions

All timeline functions are static methods and can be accessed via the `Timeline` class. Be sure to use this class.

```php
use TimelineAPI\Timeline;
```

##### pushPin (String userToken, [Pin] pin)

`Timeline::pushPin` pushes a pin to the user's timeline. It requires a valid usertoken to [target an individual user](http://developer.getpebble.com/guides/timeline/timeline-architecture/#target-individual-users).

See [responses] for what responses will be returned. More information available at [creating pins](http://developer.getpebble.com/guides/timeline/timeline-public/#create-a-pin)

Note that [updating a pin](http://developer.getpebble.com/guides/timeline/timeline-public/#update-a-pin) uses this method as well. To update a pin push the `id` of the original pin.

````php
$userToken = <Some valid userToken string>;
$pin = <some valid pin object>;
Timeline::pushPin($userToken, $pin);
````

##### pushSharedPin (String key, Array topics [Pin] pin)

`Timeline::pushSharedPin` pushes a pin to the the users' timelines. It requires a valid [API key](http://developer.getpebble.com/guides/timeline/timeline-enabling/#getting-your-api-keys) to send to [multiple users](http://developer.getpebble.com/guides/timeline/timeline-architecture/#push-to-all-users). The parameter topics is an `Array` of type `String` containing all of the topics the pin should be pushed to. `pin` is the [Pin] to send to the users subscribed to those topics.

See [responses] for what responses will be returned. More information available at [creating shared pins](http://developer.getpebble.com/guides/timeline/timeline-public/#create-a-shared-pin)

````php
$apiKey = <Your API key>;
$topics = ['Topic-1', 'Topic-2'];
$pin = <some valid pin object>;
Timeline::pushPin($apiKey, $topics, $pin);
````

##### deletePin (String userToken, String id)

`Timeline::deletePin` removes a pin to the the user's timeline. It requires a valid `usertoken` representing the watch that the pin should be removed from and the `id` of the pin to remove.

See [responses] for what responses will be returned. More information available at [deleting pins](http://developer.getpebble.com/guides/timeline/timeline-public/#delete-a-pin)

````php
$userToken = <Some valid userToken string>;
$id = 'SAMPLE-PIN';
Timeline::deletePin($userToken, $id);
````

##### deleteSharedPin (String key, String id)

`Timeline::deletePin` removes a shared pin from all users' timelines. It requires a valid It requires a valid [API key](http://developer.getpebble.com/guides/timeline/timeline-enabling/#getting-your-api-keys) along with the `id` of the pin to be removed.

See [responses] for what responses will be returned. More information available at [deleting shared pins](http://developer.getpebble.com/guides/timeline/timeline-public/#delete-a-shared-pin)

````php
$apiKey = <Some valid userToken string>;
$id = 'SAMPLE-SHARED-PIN';
Timeline::deleteSharedPin($apiKey, $id);
````


##### listSubscriptions (String userToken)

`Timeline::listSubscriptions` lists all of a user's timeline subscriptions.

See [responses] for what responses will be returned. More information available at [listing topics](http://developer.getpebble.com/guides/timeline/timeline-public/#listing-topic-subscriptions)

````php
$userToken = <Some valid userToken string>;
Timeline::listSubscriptions($userToken);
````


### Timeline Responses

All Timeline [functions] return an associated array in the following form.

````php
[status' => ['code' => RESPONSE_CODE, 'message' => RESULT_MESSAGE], 'result' => RAW_PEBBLE_RESULT]
````

`status` represents the overall status of the method called.

`code` is a valid [response code](docs/StatusCodes.md)
    
`message` is a valid [response message](docs/StatusCodes.md)
    
`result` is the raw JSON decoded object from the timeline



[Pin]: #pin-object
[PinLayout]: #layout-object
[PinNotification]: #notification-object
[PinReminder]: #reminder-object
[PinAction]: #action-object
[PinIcon]: #pinicon-constant
[PinLayoutType]: #pinlayouttype-constant
[PinLayoutTypes]: #pinlayouttype-constant
[PebbleColor]: #pebblecolor-constant
[responses]: #timeline-responses
[functions]: #timeline-functions
