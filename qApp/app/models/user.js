import DS from 'ember-data';

export default DS.Model.extend({
  username: DS.attr(),
  name: DS.attr(),
  first_name: DS.attr(),
  last_name: DS.attr(),
  nickname: DS.attr(),
  slug: DS.attr(),
  URL: DS.attr(),
  avatar: DS.attr(),
  description: DS.attr(),
  registered: DS.attr('date')
});
/*
  avatar: DS.attr(),
  description: DS.attr(),
  first_name: DS.attr(),
  last_name: DS.attr(),
  meta: DS.attr(),
  name: DS.attr(),
  nickname: DS.attr(),
  registered: DS.attr('date'),
  slug: DS.attr(),
  URL: DS.attr(),
  username: DS.attr()
*/