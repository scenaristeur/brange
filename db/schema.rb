# encoding: UTF-8
# This file is auto-generated from the current state of the database. Instead
# of editing this file, please use the migrations feature of Active Record to
# incrementally modify your database, and then regenerate this schema definition.
#
# Note that this schema.rb definition is the authoritative source for your
# database schema. If you need to create the application database on another
# system, you should be using db:schema:load, not running all the migrations
# from scratch. The latter is a flawed and unsustainable approach (the more migrations
# you'll amass, the slower it'll run and the greater likelihood for issues).
#
# It's strongly recommended to check this file into your version control system.

ActiveRecord::Schema.define(:version => 20130331192425) do

  create_table "environnements", :force => true do |t|
    t.string   "nom"
    t.text     "description"
    t.string   "parent"
    t.string   "gps"
    t.string   "panorama"
    t.string   "reseau"
    t.decimal  "nb_acces"
    t.datetime "created_at",  :null => false
    t.datetime "updated_at",  :null => false
  end

  create_table "robots", :force => true do |t|
    t.string   "nom"
    t.text     "description"
    t.string   "constructeur"
    t.string   "version"
    t.string   "environnement"
    t.string   "image_url"
    t.datetime "created_at",    :null => false
    t.datetime "updated_at",    :null => false
  end

  create_table "utilisateurs", :force => true do |t|
    t.string   "nom"
    t.string   "prenom"
    t.text     "description"
    t.string   "photo"
    t.string   "password"
    t.string   "environnement"
    t.datetime "created_at",    :null => false
    t.datetime "updated_at",    :null => false
  end

end