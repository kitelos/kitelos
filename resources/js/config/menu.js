const menu = [
  { icon: 'dashboard', text: 'dashboard', route: 'dashboard', localizable: true, },
  
  { divider: true, id: "core" },
  
  { localizable: true, icon: 'security', text: 'role', route: 'roles.index', permission: 'role.list' },
  { localizable: true, icon: 'people', text: 'user', route: 'users.index', permission: 'user.list' },
  { localizable: true, icon: 'settings', text: 'setting', route: 'settings.index', permission: 'setting.list' },

  /*__BLOCK_REPLACE__*/

  {
      icon: 'keyboard_arrow_up',
      'icon-alt': 'keyboard_arrow_down',
      text: 'example menu child',
      localizable: false,
      model: false,
      children: [
          { localozable:false, icon: 'person', text: "child one", route: 'https://mascodigo.com.bo', external: true },
          { localozable:false, icon: 'input', text: "child two", route: 'https://mascodigo.com.bo', external: true},
          { localozable:false, icon: 'person', text: "child three", route: 'https://mascodigo.com.bo', external: true },
          { localozable:false, icon: 'input', text: "child four", route: 'https://mascodigo.com.bo', external: true}
      ]
  },

  { localizable: true, icon: 'help', text: 'help', route: 'https://mascodigo.com.bo', external: true },
];

export default menu