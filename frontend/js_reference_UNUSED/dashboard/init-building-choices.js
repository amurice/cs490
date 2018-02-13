{
  const getBuildings = window.lib.api.getBuildings;
  const optionListView = window.lib.views.optionList;

  const createDropdown = document.getElementById('create-building');
  const filterDropdown = document.getElementById('building');
  const editDropdown = document.getElementById('edit-building');

  getBuildings()
    .then(buildings => buildings.sort())
    .then(optionListView)
    .then(htmlList => {
      createDropdown.innerHTML += htmlList;
      filterDropdown.innerHTML += htmlList;
      editDropdown.innerHTML += htmlList;
    });
}
