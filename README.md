# SportAlert
Web-based application that allows custom alerts to be sent to subscribers.

PURPOSE:
This is primarily targeted for sport event notifications but can be refactored to fit for any type of schedulable event. The user will be able to select a team(s), what type of alerm they would like to setup, how much time before the actual event to be notified, and additional parameters around how to query data. 

ARCHITECTURE:
The architecture can be broken down into 3 layers.
(1) The user interface will either be via email or phone. The objective here is to stay simple and to the point. The platform to update preferences can be different from the platform that receives notification.
(2) The task manager will be web-based php scheduled to run periodically off of a cron job. For starters this can all be managed on the godaddy host. This layer will do the heavy lifting of mining connecting user preferences with the sports information and handling notifications to the UI.
(3) The database layer will be the Oracle RDBMS provided by godaddy. This layer handles management of the sports team information as well as the user contact and preference data.
