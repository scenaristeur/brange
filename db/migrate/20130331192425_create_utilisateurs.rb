class CreateUtilisateurs < ActiveRecord::Migration
  def change
    create_table :utilisateurs do |t|
      t.string :nom
      t.string :prenom
      t.text :description
      t.string :photo
      t.string :password
      t.string :environnement

      t.timestamps
    end
  end
end
