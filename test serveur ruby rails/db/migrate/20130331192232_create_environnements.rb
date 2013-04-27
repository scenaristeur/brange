class CreateEnvironnements < ActiveRecord::Migration
  def change
    create_table :environnements do |t|
      t.string :nom
      t.text :description
      t.string :parent
      t.string :gps
      t.string :panorama
      t.string :reseau
      t.decimal :nb_acces

      t.timestamps
    end
  end
end
