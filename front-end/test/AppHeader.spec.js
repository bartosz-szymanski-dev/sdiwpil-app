import { mount } from '@vue/test-utils'
import {
  VAppBar,
  VIcon,
  VList,
  VListItem,
  VListItemAction,
  VListItemContent, VListItemTitle,
  VToolbarTitle
} from 'vuetify'
import AppHeader from '@/components/AppHeader'

describe('AppHeader', () => {
  test('is a Vue instance', () => {
    const wrapper = mount(AppHeader, {
      components: [VAppBar, VToolbarTitle, VList, VListItem, VListItemAction, VIcon, VListItemContent, VListItemTitle],
      propsData: {
        title: 'Title',
        items: []
      }
    })
    expect(wrapper.vm).toBeTruthy()
  })
})
