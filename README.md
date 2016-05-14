# Project 4 KaraokeTracker

## Live URL
<http://p4.pyxisweb.me>

## Description
KaraokeTracker is a karaoke event search application intended to benefit both people who enjoy participating in/watching karaoke as well as karaoke jocks (KJs) hosting karaoke events. It supports two types of registered users:

* Singers - These users are allowed to search for karaoke events, make posts to karaoke events and rate KJs and locales (locations such as a restaurant at which karaoke is offered).
* KJs - These users are allowed to create karaoke events, which include specifications of locale as well as schedule information (recurring or one-time events, start/end times, etc.) Because of the increased exposure the application provides them, KJs are expected to pay for the service and must enter credit card information in their profile.

KaraokeTracker also provides limited support for non-registered users, who may only search for events.

## Project 4 Screencast
<http://screencast.com/t/iaBjyKyU0R>

## Details for Teaching Team
### Demo Tips
The following users (listed by user type) have been seeded:

KJ users/password

* richard_blade/helloworld
* jj_walker/helloworld
* jamal/helloworld

Singer users/password:

* captain_fantastic/helloworld
* bad_girl/helloworld
* jill/helloworld

You can of course register your own users; singers only need to enter user name, password and email while KJs must enter all fields except for the optional photo upload. Any string will do for credit card, credit card month just needs to be a number from 1 to 12 and credit card year and CSV just need to be numeric.

Perhaps the best links to start out with are:

Event create (KJs only) <http://p4.pyxisweb.me/events/create> - To create an event, use the Google Maps autocomplete feature to select the location for the event, then complete the remaining scheduling information.

Event search <http://p4.pyxisweb.me/events/search> - Use the Google Maps autocomplete feature to select a search center, then change the radius as necessary (the map should start out at your location). The resulting events will then provide further links to details on specific events, KJs and locales, on which postings and ratings can be entered. The seed includes 6 events, 2 at a location in Marlborough, MA, 2 at locations in Manchester, NH, 1 in Wakefield, MA and 1 way up north in Hanover, NH.

Note on registration email - This was not yet working as I only did the necessary web hosting configuration late this morning, so the registration page might result in an error, though the registration will have been successful. If this occurs, please visit <p4.pyxisweb.me/login> to log in.

### Special Functionality

Google Maps (also see outside code section) - As mentioned above, I used Google Maps and its autocomplete feature for the event create/search functions. KaraokeTracker stores locales as Google Maps fields (Google Maps place_id, place name formatted address, latitude, longitude) so these can be rated. Locales are created if necessary when an event is created.

Ajax - I used Ajax in a number of places in KaraokeTracker including:

* Event search (search results refreshed instantly when search radius or Google Maps search center is changed)
* Event posts (new posts appear instantly)
* KJ/locale ratings (new ratings/comments appear instantly)

Geotools for Laravel - Although I did save the Google Maps place_id, I thought it would be better not to make an additional call to Google Maps, so I did the actual event search all within my application using Geotools.

User images - Three versions of uploaded images (for users and events) are saved; the original, a display image (used for profiles) and a thumbnail (used for posts/ratings and event overviews). Intervention Image made this very easy.

Carbon date handling - Carbon made it easy to handle dates; I was especially impressed at its ability to calculate the next date on which a weekday would fall (e.g. \Carbon\Carbon('next friday')).

Various javascript including a JQuery popup calendar (credit below in outside code section).

Various navigation features - nav bar based on user type (non-registered, singer, KJ), page restriction including appropriate flash messages (e.g. a singer may not access the event creation page), 

CRUD - all CRUD functions covered (user/event updates as well as deletions using onDelete('cascade')).

### Data Types and General Code Structure
Overall I felt the application was generally handling three types of data: users, events and locales and that other data types (user roles, event posts, KJ (i.e. user) ratings and locale ratings) were based on those first types. As a result I based my general application code structure on that notion:

* Controllers - UserController, EventController and LocaleController all directly in app/Http/Controllers
* Libraries - User, Event, Locale in app/Libraries (though some of my code in these files would probably be better off in the corresponding models)
* Assets (user and event images) - under appropriate user id/event id folders in public/assets/uploads/users and public/assets/uploads/users (general structure from Piazza post by Chithra Jayakumar)
* Views - divided into users/ events/ locales/ folders (as well as auth/ and layouts/).

### Views
I used two layouts, master.blade.php as well as GoogleMapsPage.blade.php (based on the master blade view) for those pages requiring a Google Map. Ajax blade views are provided in addition to basic views where appropriate.

### Javascript
I put all javascript files in public/css/; in general, a separate .js file is included for each view requiring Google Maps and/or AJAX functionality.

## Outside Code
Google Maps - mainly Autocomplete for Addresses and Search Terms feature <https://developers.google.com/maps/documentation/javascript/places-autocomplete>, modified/learned from Places code samples (links at
at <https://developers.google.com/maps/documentation/javascript/examples/#basics>)

Intervention Image <http://image.intervention.io/>

Geotools for Lavarel 4 & 5 <https://github.com/toin0u/Geotools-laravel> (github link)

Jquery ui datepicker <https://jqueryui.com/datepicker/>

Carbon

Modified/learned from Susan's Ajax code <https://github.com/susanBuck/dwa15-spring2016-notes/blob/master/03_Laravel/30_Ajax.md>

User upload folder structure based on Piazza suggestion from Chithra Jayakumar.
