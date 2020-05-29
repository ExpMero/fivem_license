local Tunnel = module("vrp", "lib/Tunnel")
local Proxy = module("vrp", "lib/Proxy")
local Lang = module("vrp", "lib/Lang")


vRP = Proxy.getInterface("vRP")

local name = 'exp_t'
local start = false

AddEventHandler('onResourceStart', function(resourceName)
    if (GetCurrentResourceName() == resourceName) then
        PerformHttpRequest("http://localhost/license/connect.php?license=" .. config.key .. "&name=" .. name, function (errorCode, resultData, resultHeaders)
                if (resultData == 'yes')then
                  start = true
                  print(name .. ' IS RUN SUCCESSFULY')
                else
                  print('Call Exp#0001 On Discord')
                end
          end)
      return
    end
  end)



  -- [[ EXAMPLE ]]
  
vRP.registerMenuBuilder({"admin", function(add, data)
  if start == true then
  local user_id = vRP.getUserId({data.player})
  if user_id ~= nil then
    local choices = {}
     choices[''] = '' 
    add(choices)
  end
end
end})


