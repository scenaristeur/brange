require 'test_helper'

class UtilisateursControllerTest < ActionController::TestCase
  setup do
    @utilisateur = utilisateurs(:one)
  end

  test "should get index" do
    get :index
    assert_response :success
    assert_not_nil assigns(:utilisateurs)
  end

  test "should get new" do
    get :new
    assert_response :success
  end

  test "should create utilisateur" do
    assert_difference('Utilisateur.count') do
      post :create, utilisateur: { description: @utilisateur.description, environnement: @utilisateur.environnement, nom: @utilisateur.nom, password: @utilisateur.password, photo: @utilisateur.photo, prenom: @utilisateur.prenom }
    end

    assert_redirected_to utilisateur_path(assigns(:utilisateur))
  end

  test "should show utilisateur" do
    get :show, id: @utilisateur
    assert_response :success
  end

  test "should get edit" do
    get :edit, id: @utilisateur
    assert_response :success
  end

  test "should update utilisateur" do
    put :update, id: @utilisateur, utilisateur: { description: @utilisateur.description, environnement: @utilisateur.environnement, nom: @utilisateur.nom, password: @utilisateur.password, photo: @utilisateur.photo, prenom: @utilisateur.prenom }
    assert_redirected_to utilisateur_path(assigns(:utilisateur))
  end

  test "should destroy utilisateur" do
    assert_difference('Utilisateur.count', -1) do
      delete :destroy, id: @utilisateur
    end

    assert_redirected_to utilisateurs_path
  end
end
