var china = [
 //直辖市
 ['北京'],
 ['上海'],
 ['天津'],
 ['重庆'],
 //华北地区
 ['河北','石家庄','唐山','秦皇岛','邯郸','邢台','保定','张家口','承德','沧州','廊坊','衡水'],
 ['山西','太原','大同','阳泉','长治','晋城','朔州','晋中','运城','忻州','临汾','吕梁'],
 ['内蒙古','呼和浩特','包头','乌海','赤峰','通辽','鄂尔多斯','呼伦贝尔','巴彦淖尔','乌兰察布','兴安盟','锡林郭勒盟','阿拉善盟'],
 //东北地区
 ['辽宁','沈阳','大连','鞍山','抚顺','本溪','丹东','锦州','营口','阜新','辽阳','盘锦','铁岭','朝阳','葫芦岛'],
 ['吉林','长春','吉林市','四平','辽源','通化','白山','松原','白城','延边'],
 ['黑龙江','哈尔滨','齐齐哈尔','鸡西','鹤岗','双鸭山','大庆','伊春','佳木斯','七台河','牡丹江','黑河','绥化','大兴安岭'],
 //华东地区
 ['江苏','南京','无锡','徐州','常州','苏州','南通','连云港','淮安','盐城','扬州','镇江','泰州','宿迁'],
 ['浙江','杭州','宁波','温州','嘉兴','湖州','绍兴','金华','衢州','舟山','台州','丽水'],
 ['安徽','合肥','芜湖','蚌埠','淮南','马鞍山','淮北','铜陵','安庆','黄山','滁州','阜阳','宿州','巢湖','六安','亳州','池州','宣城'],
 ['福建','福州','厦门','莆田','三明','泉州','漳州','南平','龙岩','宁德'],
 ['江西','南昌','景德镇','萍乡','九江','新余','鹰潭','赣州','吉安','宜春','抚州','上饶'],
 ['山东','济南','青岛','淄博','枣庄','东营','烟台','潍坊','威海','济宁','泰安','日照','莱芜','临沂','德州','聊城','滨州','菏泽'],
 //中南地区
 ['河南','郑州','开封','洛阳','平顶山','焦作','鹤壁','新乡','安阳','濮阳','许昌','漯河','三门峡','南阳','商丘','信阳','周口','驻马店'],
 ['湖北','武汉','黄石','襄樊','十堰','荆州','宜昌','荆门','鄂州','孝感','咸宁','随州','恩施'],
 ['湖南','长沙','株洲','湘潭','衡阳','邵阳','岳阳','常德','张家界','益阳','郴州','永州','怀化','娄底','湘西'],
 ['广东','广州','深圳','珠海','汕头','韶关','佛山','江门','湛江','茂名','肇庆','惠州','梅州','汕尾','河源','阳江','清远','东莞','中山','潮州','揭阳','云浮'],
 ['广西','南宁','柳州','桂林','梧州','北海','防城港','钦州','贵港','玉林','百色','贺州','河池','来宾','崇左'],
 ['海南','海口','三亚','白沙','保亭','昌江','儋州','澄迈','东方','定安','琼海','琼中','乐东','临高','陵水','屯昌','万宁','文昌','五指山'],
 //西南地区
 ['四川','成都','自贡','攀枝花','泸州','德阳','绵阳','广元','遂宁','内江','乐山','南充','宜宾','广安','达州','眉山','雅安','巴中','资阳',"阿坝州","甘孜州","凉山州"],
 ['贵州','贵阳',"六盘水","遵义","安顺","铜仁地区","毕节地区","黔西南州","黔东南州","黔南州"],
 ['云南','昆明','曲靖','玉溪',"保山","昭通","丽江","普洱","临沧","文山","红河","西双版纳","楚雄州","大理州","德宏州","怒江","迪庆州"],
 ['西藏',"拉萨","昌都地区","山南地区","日喀则地区","那曲地区","阿里地区","林芝地区"],
 //西北地区
 ['陕西','西安','铜川','宝鸡','咸阳','渭南','延安','汉中','榆林','安康','商洛'],
 ['甘肃',"兰州","嘉峪关","金昌","白银","天水","武威","张掖","平凉","酒泉","庆阳","定西","陇南","临夏州","甘南州"],
 ['青海',"西宁","海东地区","海北州","黄南州","海南州","果洛州","玉树","海西州"],
 ['宁夏','银川',"石嘴山","吴忠","固原","中卫"],
 ['新疆','乌鲁木齐',"克拉玛依","吐鲁番地区","哈密地区","和田地区","阿克苏地区","喀什地区","克孜勒苏州","巴音郭楞","昌吉州","博尔塔拉州","伊犁州","塔城地区","阿勒泰地区","阿拉尔","石河子","图木舒克","五家渠"],
 //港澳台
 ['香港'],
 ['澳门'],
 ['台湾']
 ];

 function bindProvince(){
    var opt0 = "省份";
    var ProvinceCount=china.length;
    var ddlProvince = document.getElementById("ddlProvince");
    ddlProvince.innerHTML = "";
	/**var e = document.getElementById("selectId");
		e. options= new Option("文本","值") ;
		创建一个option对象,即在<select>标签中创建一个或多个<option value="值">文本</option>*/
    ddlProvince.options[0] = new Option(opt0,"");
    for(var i=0; i<ProvinceCount; i++){
        ddlProvince.options[i+1] = new Option(china[i][0],china[i][0]);
    }
 }

 function bindCity(City){
    var opt0 = "省份";
    var ProvinceCount=china.length;
    var ddlProvince = document.getElementById("ddlProvince");
    ddlProvince.innerHTML = "";
    ddlProvince.options[0] = new Option(opt0,"");
    
    var opt0City = "城市";
    var ddlCity = document.getElementById("ddlCity");
    ddlCity.innerHTML = "";
    ddlCity.options[0] = new Option(opt0City,"");

    var flag=false;
    var chose=true;
    var selectProvinceIndex=0;
    for(var i=0; i<ProvinceCount; i++){
        if(!flag){
            var cityCount = china[i].length;
            for(var j=1; j<cityCount; j++){
                if(china[i][j]==City)
                {
                    flag=true;
                    selectProvinceIndex=i;
                    break;
                }
            }
        }
        ddlProvince.options[i+1] = new Option(china[i][0],china[i][0]);
        if(flag && chose){
            ddlProvince.options[i+1].selected = true;
            chose=false;
        }
    }
    var cityCount = china[selectProvinceIndex].length;
    for(var i=0; i<cityCount; i++){
        if(cityCount == 1 && i == 0){
            ddlCity.options[i+1] = new Option(china[selectProvinceIndex][i],china[selectProvinceIndex][i]);
            i = 1;
        }
        else if(cityCount > 1 && i == 0){
            i = 1;
            ddlCity.options[i] = new Option(china[selectProvinceIndex][i],china[selectProvinceIndex][i]);
        }
        else{
            ddlCity.options[i] = new Option(china[selectProvinceIndex][i],china[selectProvinceIndex][i]);
        }
        if(china[selectProvinceIndex][i]==City){
            ddlCity.options[i].selected=true;
        }
    }

 }

 function selectMoreCity(sbj){
        var opt0 = "城市";
        if(sbj.selectedIndex==0){
            var ddlCity = document.getElementById("ddlCity");
            ddlCity.innerHTML = "";
            ddlCity.options[0] = new Option(opt0,"");
            return;
        }
        var selectProvince = sbj.options[sbj.selectedIndex].value;
        var ProvinceCount = china.length;
        for(var i=0; i<ProvinceCount; i++){
            if(china[i][0] == selectProvince){
                var cityCount = china[i].length;
                var ddlCity = document.getElementById("ddlCity");
                ddlCity.innerHTML = "";
                ddlCity.options[0] = new Option(opt0,"");
                for(var j=0; j<cityCount; j++){
                    if(cityCount == 1 && j == 0){
                        ddlCity.options[j+1] = new Option(china[i][j],china[i][j]);
                        j = 1;
                    }
                     else if(cityCount > 1 && j == 0){
                        j = 1;
                         ddlCity.options[j] = new Option(china[i][j],china[i][j]);
                     }
                     else{
                         ddlCity.options[j] = new Option(china[i][j],china[i][j]);
                    }
                    if(j == 1){
                         ddlCity.options[1].selected = true;
                    }
                }
                break;
            }
        }
    }
/**根据下标选择*/
function selectMoreCityByIndex(domObj,selectedIndex){
	ddlProvince.options[selectedIndex].selected = true;
	var opt0 = "城市";
	if(selectedIndex==0){
		var ddlCity = document.getElementById("ddlCity");
		ddlCity.innerHTML = "";
		ddlCity.options[0] = new Option(opt0,"");
		return;
	}
	
	var selectProvince = domObj.options[selectedIndex].value;
	var ProvinceCount = china.length;
	for(var i=0; i<ProvinceCount; i++){
		if(china[i][0] == selectProvince){
			var cityCount = china[i].length;
			var ddlCity = document.getElementById("ddlCity");
			ddlCity.innerHTML = "";
			ddlCity.options[0] = new Option(opt0,"");
			for(var j=0; j<cityCount; j++){
				if(cityCount == 1 && j == 0){
					ddlCity.options[j+1] = new Option(china[i][j],china[i][j]);
					j = 1;
				}
				 else if(cityCount > 1 && j == 0){
					j = 1;
					 ddlCity.options[j] = new Option(china[i][j],china[i][j]);
				 }
				 else{
					 ddlCity.options[j] = new Option(china[i][j],china[i][j]);
				}
				if(j == 1){
					 ddlCity.options[1].selected = true;
				}
			}
			break;
		}
	}
}