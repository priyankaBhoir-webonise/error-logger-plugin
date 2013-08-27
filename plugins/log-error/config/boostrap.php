<?php
//File: /app/plugins/lcp/config/bootstrap.php

// in this case our PluginHandler will overwrite default language
// if any was set in one of the app/config/ configuration files
Configure::write('Config.language', 'en');
?> 