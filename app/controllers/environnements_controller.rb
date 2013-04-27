class EnvironnementsController < ApplicationController
  # GET /environnements
  # GET /environnements.json
  def index
    @environnements = Environnement.all

    respond_to do |format|
      format.html # index.html.erb
      format.json { render json: @environnements }
    end
  end

  # GET /environnements/1
  # GET /environnements/1.json
  def show
    @environnement = Environnement.find(params[:id])

    respond_to do |format|
      format.html # show.html.erb
      format.json { render json: @environnement }
    end
  end

  # GET /environnements/new
  # GET /environnements/new.json
  def new
    @environnement = Environnement.new

    respond_to do |format|
      format.html # new.html.erb
      format.json { render json: @environnement }
    end
  end

  # GET /environnements/1/edit
  def edit
    @environnement = Environnement.find(params[:id])
  end

  # POST /environnements
  # POST /environnements.json
  def create
    @environnement = Environnement.new(params[:environnement])

    respond_to do |format|
      if @environnement.save
        format.html { redirect_to @environnement, notice: 'Environnement was successfully created.' }
        format.json { render json: @environnement, status: :created, location: @environnement }
      else
        format.html { render action: "new" }
        format.json { render json: @environnement.errors, status: :unprocessable_entity }
      end
    end
  end

  # PUT /environnements/1
  # PUT /environnements/1.json
  def update
    @environnement = Environnement.find(params[:id])

    respond_to do |format|
      if @environnement.update_attributes(params[:environnement])
        format.html { redirect_to @environnement, notice: 'Environnement was successfully updated.' }
        format.json { head :no_content }
      else
        format.html { render action: "edit" }
        format.json { render json: @environnement.errors, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /environnements/1
  # DELETE /environnements/1.json
  def destroy
    @environnement = Environnement.find(params[:id])
    @environnement.destroy

    respond_to do |format|
      format.html { redirect_to environnements_url }
      format.json { head :no_content }
    end
  end
end
