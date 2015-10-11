jQuery(($) ->
  'use strict'

  urls =
    widgetAdminRouteFields: (route) ->
      Routing.generate('widget_admin_route_fields', { route: route } )

  $('.route-fields').closest('.form-group').append('<div class="route-fields-wrapper"></div>')
  $routeFieldsWrapper = $('.route-fields-wrapper')

  $('select[name$="[route][name]"]').on('change', () ->
    $selectRouteName = $(this)
    partName = $selectRouteName.attr('name').replace(/\[name\]$/, '[parameters]')
    val = $selectRouteName.val()

    if val
      $.get(urls.widgetAdminRouteFields(val)).done((response) ->

        $response = $(response).find('input,select,textarea').each(() ->
          $this = $(this)
          $this.attr('name', partName + $this.attr('name').match(/\[.*\]$/)[0])
        )
        $routeFieldsWrapper.html($response)
      )
    else
      $routeFieldsWrapper.empty()
  )
)
