// pages/application/index.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    openid: '',
    seat_select: '',
    floor: [{
        name: '一楼',
        id: '1',
        color: '#EEE8CD'
      },
      {
        name: '二楼',
        id: '2',
        color: '#fff'
      },
      {
        name: '三楼',
        id: '3',
        color: '#fff'
      },
      {
        name: '四楼',
        id: '4',
        color: '#fff'
      },
      {
        name: '五楼',
        id: '5',
        color: '#fff'
      },

    ],
    color: '#fff',
    list: [{
        id: 1,
        seatid: '2A001',
        floor: '2',
        area: 'A',
        num: '001',
        status: '1'
      },
      {
        id: 1,
        seatid: '2A001',
        floor: '2',
        area: 'A',
        num: '001',
        status: '2'
      }
    ],
    canIUse: wx.canIUse('button.open-type.getUserInfo'),
    display: false
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function(options) {
    var that = this
    // 查看是否授权
    wx.getSetting({
      success: function(res) {

        if (res.authSetting['scope.userInfo']) {
          // 已经授权，可以直接调用 getUserInfo 获取头像昵称
          wx.getUserInfo({
            success: function(rs) {

            }
          })
          that.setData({
            display: false
          })
        } else {
          //未授权
          that.setData({
            display: true
          })
        }
      }
    })


    that.setData({
      'floor[0].color': '#EEE8CD',
      'floor[1].color': '#fff',
      'floor[2].color': '#fff',
      'floor[3].color': '#fff',
      'floor[4].color': '#fff',

    })

    wx.request({
      url: 'https://qtmami.com/tsg/index.php/Home/Wechat/seat/floor/' + '1',
      header: {
        'content-type': 'application/json'
      },
      method: 'GET',
      success: function(rs) {
        console.log(rs.data)
        that.setData({
          list: rs.data
        })
      },

    })

    wx.login({
      success: function(res) {
        console.log(res)
        wx.request({
          url: 'https://qtmami.com/tsg/index.php/Home/Wechat/openid/code/' + res.code,
          header: {
            'content-type': 'application/json'
          },
          method: 'GET',
          success: function(e) {
            console.log('openid为：', e.data)
            that.setData({
              openid: e.data
            })

            wx.request({
              url: 'https://qtmami.com/tsg/index.php/Home/Wechat/seachuser/openid/' + e.data,
              header: {
                'content-type': 'application/json'
              },
              method: 'GET',
              success: function(rs) {
                console.log(rs.data)
                if (rs.data == 18012) {
                  wx.redirectTo({
                    url: '/pages/login/login',
                  })
                }

              },

            })
          },

        })

      }
    })
  },
  floor: function(e) {
    var that = this
    //清空楼层按钮选中的颜色，将所有按钮变成白色透明
    that.setData({
      'floor[0].color': '#fff',
      'floor[1].color': '#fff',
      'floor[2].color': '#fff',
      'floor[3].color': '#fff',
      'floor[4].color': '#fff',

    })

    console.log('所选楼层', e.target.id)
    //定义表示楼层的id
    var id = e.target.id
    //将选中的楼层所对应的按钮设置背景色#EEE8CD
    var fid = id - 1
    var param = {};
    var str = "floor[" + fid + "].color"
    param[str] = '#EEE8CD';
    that.setData(param);

    //获取选中楼层的座位信息
    wx.request({
      url: 'https://qtmami.com/tsg/index.php/Home/Wechat/seat/floor/' + id,
      header: {
        'content-type': 'application/json'
      },
      method: 'GET',
      success: function(rs) {
        console.log(rs.data)
        that.setData({
          list: rs.data,

        })
      },

    })

  },
  icon: function(e) {
    var that = this
    console.log(e)
    console.log('选座', e.target.id)
    that.setData({
      seat_select: e.target.id
    })
  },
  btn_ok: function(e) {
    var that = this
    var seatid = this.data.seat_select
    var openid = this.data.openid
    if (seatid == '') {
      wx.showToast({
        title: '请选择座位',
        icon: 'loading',
        duration: 2000
      })
    } else {
      console.log('确认预约', seatid)
      console.log('提取openid', openid)
      wx.request({
        url: 'https://qtmami.com/tsg/index.php/Home/Wechat/appointment',
        header: {
          'content-type': 'application/json'
        },
        data: {
          seatid: seatid,
          openid: openid
        },
        method: 'GET',
        success: function(e) {
          console.log('返回值为：', e.data)
          if (e.data == '17005') {
            wx.showToast({
              title: '预约成功',
              icon: 'loading',
              duration: 2000
            })
            wx.switchTab({
              url: '/pages/index/index'
            })
          }
          if (e.data == '18006') {
            wx.showToast({
              title: '请勿重复占座',
              icon: 'loading',
              duration: 2000
            })
          }
          if (e.data == '18007') {
            wx.showToast({
              title: '请勿重复预约',
              icon: 'loading',
              duration: 2000
            })
          }
          if (e.data == '18008') {
            wx.showToast({
              title: '此座已占',
              icon: 'loading',
              duration: 2000
            })
          }

        },

      })
    }

  },
  onPullDownRefresh: function() {
    this.onLoad();
    wx.stopPullDownRefresh({

    })

  },
  bindGetUserInfo: function(e) {
    console.log(e.detail.userInfo)
  }
})