import config from "./utils/config"
import util from "./utils/util"
const u_id = config.u_id
App({
  onLaunch: function (ops) {
    var logs = wx.getStorageSync('logs') || []
    logs.unshift(Date.now())
    wx.setStorageSync('logs', logs)

    var that = this


    util.userLogin(function(result){
      //登陆成功后再解密用户资料
        that.globalData.testinfo = that.globalData.testinfo+"\n"+"userLogin"
        console.log(result)
    });

    wx.authorize({
      scope:"scope.userInfo",
      success:res=>{
        that.globalData.testinfo = that.globalData.testinfo+"\n"+"authorize ok" /*debug*/

        wx.getUserInfo({
          withCredentials :true,
          success: res => {
            //微信登陆.
            //小程序在群里被打开时,展示该数据
          if (ops != null && ops.scene == 1044)  {
            wx.getShareInfo({
                shareTicket:ops.shareTicket,
                success:(res)=>{
                      util.encrypt(res,(result)=>{
                          this.globalData.testinfo = this.globalData.testinfo+"\n"+"INIT encrypt"
                          console.log("encrypt",result)
                          util.getGroup(result,r=>{
                              this.globalData.testinfo = this.globalData.testinfo+"\n"+"INIT getGroup"+r.gid
                            console.log(r)
                          });
                      })
                }
              })
            }

            util.encrypt(res,function(r){
              that.globalData.testinfo = that.globalData.testinfo+"\n"+"encrypt" /*debug*/
              console.log("取得用户信息",r);
              util.getInit(r,(re)=>{
                that.globalData.testinfo = that.globalData.testinfo+"\n"+"getInit" /*debug*/
                console.log("取得uid成功.init成功",re.data)
                console.log(re.data.uid)
                console.log(re.data.config)
                that.globalData.uid = re.data.uid;
                that.globalData.config = re.data.config;
              })
            })

            this.globalData.testinfo = this.globalData.testinfo+"\n"+"进入getUserInfo" /*debug*/

            this.globalData.rawData = res.rawData
            this.globalData.userInfo = res.userInfo
            if (this.userInfoReadyCallback) {
              this.userInfoReadyCallback(res)
            }
          },
          fail: err=>{
          }
        })
      }
    })
  },

  globalData: {
    userInfo: null,
    rawData:null,
    uid:null,
    config:{},
    UserInfo:{},
    shareTicket:null,
    testinfo:""
  }

})
