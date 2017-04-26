#sudo apt-get update
#sudo apt-get install gpac

from subprocess import call


#put above def recordMotion
#This needs to be pathed to the folder containing the files
def convertToMP4:
    convertToMP4 = "This needs to be pathed to the folder containing the files/MP4Box -add " + timeFileName  + ".h264 " + timeFileName ".mp4"
    call (convertToMP4, shell=True)


#to be put under print ("done recording") on line ~109
tconv = threading.Thread(target=convertToMP4)
tconv.start()
