ScnSocialAuthDoctrineORM
========================

An extension of [ScnSocialAuth](https://github.com/SocalNick/ScnSocialAuth) that provides integration with Doctrine2 ORM.


Configuration
-------------

An entity is provided for UserProvider.  Based on the setting of 
`$config['scn-social-auth']['enable_default_entities']` will the included entity
be used.  To override the entity use 
`$config['scn-social-auth']['user_provider_entity_class']`
