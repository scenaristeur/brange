class Environnement < ActiveRecord::Base
  attr_accessible :description, :gps, :nb_acces, :nom, :panorama, :parent, :reseau
end
