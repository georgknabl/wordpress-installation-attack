# WordPress Installation Attack

This attack targets insecurely setup WordPress installations that have an open installation process publicly available and database credentials set.

WARNING: This script is for educational purposes (e.g. awareness trainings) only! Do NOT use it to actually attack someone's website! To prevent script kiddies from using it, the actual backdoor code has been removed.

## How this attack works

When installing WordPress, a publicly available setup process has to be completed. If the database credentials are already set in wp-config.php, attackers are able to hijack this installation by running the setup and installing a plugin as admin that generates a backdoor. Afterwards, the plugin itself and the created database tables are removed which causes WordPress to start a new installation process. However, the backdoor persists. Developers might not notice the difference.

Of course, this installation timeframe might only be available for a very short time. Fortunately, all discussed steps can be automated to run in a few fractions of a second.

## Mitigation

There are several options to secure a WordPress installation:
* Ensure only authorized people access the installation process by whitelisting the developer's IP address and locking all others out.
* Prevent database access until the actual setup.
* Don't run the setup on public servers at all and prepare a ready database on a secure development environment.

## Setup

You might want to automate this process as it might require to be faster than the developer setting up the system.

* Prepare the backdoor-creator-plugin.php: Add backdoor code of your choice (e.g. a PHP shell) and the target backdoor path and create a zip file.
* Find an unprotected WordPress installation that redirects to /wp-admin/install.php (and thus has an open setup process available). This only works if the database credentials are already set.
* Complete the WordPress setup and log in to wp-admin.
* Go to Plugins / Add new / Upload and upload the zip file.
* Activate the plugin.
* Create the backdoor by calling https://www.target-website.com/?create (You may change this attribute hook name in the PHP file.).
* Wait until the developer completes the setup. Now you can access the backdoor via the previously specified URL.