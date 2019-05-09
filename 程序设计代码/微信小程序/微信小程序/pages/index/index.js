// pages/card/card.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    openid: 0,
    url: ''
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this;
    wx.login({
      success: function (res) {
        console.log(res)
        wx.request({
          url: 'https://118.25.4.219/tsg/index.php/Home/Wechat/openid/code/' + res.code,
          header: {
            'content-type': 'application/json'
          },
          method: 'GET',
          success: function (e) {
            console.log(e.data)
            that.setData({
              openid: e.data
            })
            wx.request({
              url: 'https://118.25.4.219/tsg/index.php/Home/Wechat/code/openid/' + e.data,
              header: {
                'content-type': 'application/json'
              },
              method: 'GET',
              success: function (rs) {
                console.log(rs.data)
                if (rs.data == 18009) {
                  wx.showToast({
                    title: '请先预约座位',
                    icon: 'loading',
                    duration: 2000
                  })
                  that.setData({
                    url: null
                  })
                }
                else if (rs.data == '18011') {
                  wx.showToast({
                    title: '到馆超时！',
                    icon: 'loading',
                    duration: 2000
                  })
                  that.setData({
                    url: null
                  })
                } 
                else if (rs.data == '18010') {
                  wx.showToast({
                    title: '请勿重复占座',
                    icon: 'loading',
                    duration: 2000
                  })
                  that.setData({
                    url: null
                  })
                }
                else {
                  wx.showToast({
                    title: '获取成功',
                    icon: 'success',
                    duration: 1500
                  })
                  that.setData({
                    url: rs.data
                  })
                }



              },

            })


          },

        })

      }
    })

  },

  onPullDownRefresh: function () {
    this.onLoad();
    wx.stopPullDownRefresh({

    })

  },
  
})