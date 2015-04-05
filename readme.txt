1. Download the latest version from repository (github?beanstalk?)
2. Load the theme to the wordpress wp-content folder
3. open includes/theme_globals.php and update as required
4. Rename the theme to represent the client site
5. Login to wordpress and activate the theme
6. Navigate to theme customizer and update ALL theme settings. Save the changes
7. Hook up Google fonts if required.
8. Add cpt_, tax_, meta_, as requried. sample templates are included
9. Build page templates and site content as required
10. Update static style in includes/style.css. Dynamic style is to be udpated in includes/theme_style.php or inline
11. Remember to use bb_e and bb_r to call custom elements (see inline comments in includes/theme_globals.php)