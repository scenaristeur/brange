class Utilisateur < ActiveRecord::Base
  attr_accessible :description, :environnement, :nom, :password, :photo, :prenom
end
