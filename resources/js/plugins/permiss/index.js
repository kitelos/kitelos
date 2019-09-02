const permissPlugin = {
  install (Vue, options) {

    Vue.rulesPermiss = []

    Vue.updatePermiss = function (rules) {
      Vue.rulesPermiss = rules
    }
    
    Vue.getPermiss = function () {
      return Vue.rulesPermiss
    }
  
    Vue.prototype.$can = function (permission) {
      return Vue.rulesPermiss.includes(permission) ? true: false; 
    }
  }
}

export default permissPlugin