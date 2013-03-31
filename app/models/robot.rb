class Robot < ActiveRecord::Base
  attr_accessible :constructeur, :description, :environnement, :image_url, :nom, :version, :version
end
