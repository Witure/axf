Page({

  /**
   * 页面的初始数据
   */
  data: {
    show: "",
  },
  click: function () {
    var that = this;
    var seatid=this.data
    wx.scanCode({
      success: (res) => {
        this.show =res.result;
        that.setData({
          show: this.show
        })
        wx.showToast({
          title: '成功',
          icon: 'success',
          duration: 2000
        })
        console.log(seatid)
        wx.request({
          url: 'https://qtmami.com/tsg/index.php/Home/Wechat/study/',
          data:{
            seatid:seatid
          },
          header: {
            'content-type': 'application/json'
          },
          method: 'GET',
        //  success(res) {
        //    console.log(res.data)
        //    this.show = "结果:" + res.result;
        //    that.setData({
        //      show: this.show
        //    })
        //  }
        })
      },
      fail: (res) => {
        wx.showToast({
          title: '失败',
          icon: 'success',
          duration: 2000
        })
      },
    })
    
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {

  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})