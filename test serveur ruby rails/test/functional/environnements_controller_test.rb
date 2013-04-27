require 'test_helper'

class EnvironnementsControllerTest < ActionController::TestCase
  setup do
    @environnement = environnements(:one)
  end

  test "should get index" do
    get :index
    assert_response :success
    assert_not_nil assigns(:environnements)
  end

  test "should get new" do
    get :new
    assert_response :success
  end

  test "should create environnement" do
    assert_difference('Environnement.count') do
      post :create, environnement: { description: @environnement.description, gps: @environnement.gps, nb_acces: @environnement.nb_acces, nom: @environnement.nom, panorama: @environnement.panorama, parent: @environnement.parent, reseau: @environnement.reseau }
    end

    assert_redirected_to environnement_path(assigns(:environnement))
  end

  test "should show environnement" do
    get :show, id: @environnement
    assert_response :success
  end

  test "should get edit" do
    get :edit, id: @environnement
    assert_response :success
  end

  test "should update environnement" do
    put :update, id: @environnement, environnement: { description: @environnement.description, gps: @environnement.gps, nb_acces: @environnement.nb_acces, nom: @environnement.nom, panorama: @environnement.panorama, parent: @environnement.parent, reseau: @environnement.reseau }
    assert_redirected_to environnement_path(assigns(:environnement))
  end

  test "should destroy environnement" do
    assert_difference('Environnement.count', -1) do
      delete :destroy, id: @environnement
    end

    assert_redirected_to environnements_path
  end
end
