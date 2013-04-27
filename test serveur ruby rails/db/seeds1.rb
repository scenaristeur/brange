# This file should contain all the record creation needed to seed the database with its default values.
# The data can then be loaded with the rake db:seed (or created alongside the db with db:setup).
#
# Examples:
#
#   cities = City.create([{ name: 'Chicago' }, { name: 'Copenhagen' }])
#   Mayor.create(name: 'Emanuel', city: cities.first)


Environnement.delete_all
# . . .
Environnement.create(:nom => 'Maison',
:description =>
%{<p>
Une petite description de cet endroit
</p>},
:parent	=>'monde',
:gps	=>0,
:panorama => '/images/ruby.jpg',
:reseau => 'SSID du wifi de la maison',
:nb_acces => 3)

Environnement.create(:nom => 'House',
:description =>
%{<p>
Put what you want
</p>},
:parent	=>'world',
:gps	=>0,
:panorama => '/images/ruby.jpg',
:reseau => 'SSID',
:nb_acces => 3)

Environnement.create(:nom => 'Cuisine',
:description =>
%{<p>
Une petite description de cet endroit
</p>},
:parent => 'Maison',
:gps	=>0,
:panorama => '/images/ruby.jpg',
:reseau => '',
:nb_acces => 3)

Environnement.create(:nom => 'Kitchen',
:description =>
%{<p>
What ever you want !
</p>},
:parent	=>'House',
:gps	=>0,
:panorama => '/images/ruby.jpg',
:reseau => 'SSID du wifi de la maison',
:nb_acces => 3)


Environnement.delete_all
# . . .
Environnement.create(:nom => 'Maison',
:description =>
%{<p>
Une petite description de cet endroit
</p>},
:parent	=>'monde',
:gps	=>0,
:panorama => '/images/ruby.jpg',
:reseau => 'SSID du wifi de la maison',
:nb_acces => 3)

Environnement.create(:nom => 'House',
:description =>
%{<p>
Put what you want
</p>},
:parent	=>'world',
:gps	=>0,
:panorama => '/images/ruby.jpg',
:reseau => 'SSID',
:nb_acces => 3)

Environnement.create(:nom => 'Cuisine',
:description =>
%{<p>
Une petite description de cet endroit
</p>},
:parent => 'Maison',
:gps	=>0,
:panorama => '/images/ruby.jpg',
:reseau => '',
:nb_acces => 3)

Utilisateur.delete_all
# . . .
Utilisateur.create(:nom => 'Fave',
:prenom => 'Dave',
:description =>
%{<p>
Développeur !
</p>},
:photo => '/images/ruby.jpg',
:password => '****',
:environnement=> 'Maison')


Utilisateur.create(:nom => 'Fave',
:prenom => 'Fiston',
:description =>
%{<p>
fiston de developpeur !
</p>},
:photo => '/images/ruby.jpg',
:password => '****',
:environnement=> 'Maison')

Utilisateur.create(:nom => 'Yourname',
:prenom => 'Yourfirstname',
:description =>
%{<p>
Developper
</p>},
:photo => '/images/ruby.jpg',
:password => '****',
:environnement=> 'House')


Utilisateur.create(:nom => 'Yourname',
:prenom => 'MySon',
:description =>
%{<p>
son of the Developper
</p>},
:photo => '/images/ruby.jpg',
:password => '****',
:environnement=> 'House')

Robot.delete_all
# . . .
Robot.create(:nom => 'Roby',
:description =>
%{<p>
Robot qui n en rame pas une pour l'instant, et qui prefere se taper la discut  
</p>},
:constructeur	=>'Geo TrouveTout',
:version	=>1,
:environnement	=> 'Maison',
:image_url => '/images/ruby.jpg')

Robot.create(:nom => 'Robi',
:description =>
%{<p>
What can do this bot 
</p>},
:constructeur	=>'Ave GoodIdea',
:version	=>1,
:environnement	=> 'House',
:image_url => '/images/ruby.jpg')

Robot.create(:nom => 'Pob',
:description =>
%{<p>
Robot modulaire 
</p>},
:constructeur	=>'Pob Technologies',
:version	=>1,
:environnement	=> 'Maison',
:image_url => '/images/ruby.jpg')

Robot.create(:nom => 'Hoover',
:description =>
%{<p>
What can do this bot 
</p>},
:constructeur	=>'Ave GoodIdea',
:version	=>1,
:environnement	=> 'House',
:image_url => '/images/ruby.jpg')

