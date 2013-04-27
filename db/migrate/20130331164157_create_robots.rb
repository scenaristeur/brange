class CreateRobots < ActiveRecord::Migration
  def change
    create_table :robots do |t|
      t.string :nom
      t.text :description
      t.string :constructeur
      t.string :version
      t.string :environnement
      t.string :image_url
      t.decimal :version

      t.timestamps
    end
  end
end
